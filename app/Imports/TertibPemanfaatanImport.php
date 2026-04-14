<?php

namespace App\Imports;

use App\Models\TertibPemanfaatan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TertibPemanfaatanImport implements ToModel, WithStartRow
{
    /**
     * Convert Excel date to Carbon date format
     * Excel stores dates as serial numbers (days since 1900-01-01)
     *
     * @param mixed $value
     * @return string|null
     */
    private function convertExcelDate($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        // If already a string (formatted date), try to parse it
        if (is_string($value)) {
            try {
                return Carbon::parse($value)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        // Handle Excel serial date (numeric value)
        // Excel serial date: days since 1900-01-00 (Jan 1 1900 = 1)
        // Note: Excel incorrectly treats 1900 as leap year (bug for compatibility)
        if (is_numeric($value)) {
            $excelEpoch = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
            if ($excelEpoch) {
                return Carbon::instance($excelEpoch)->format('Y-m-d');
            }
        }

        return null;
    }

    /**
     * Safely get value from row array
     *
     * @param array $row
     * @param int $index
     * @return mixed
     */
    private function getValue(array $row, int $index)
    {
        return isset($row[$index]) ? $row[$index] : null;
    }

    /**
     * Convert Indonesian Rupiah format to integer
     * Example: "Rp. 98.844.501,00,-" -> 98844501
     *
     * @param mixed $value
     * @return int|null
     */
    private function convertRupiah($value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        // Convert to string
        $value = trim((string) $value);

        // Remove "Rp." prefix and spaces
        $value = preg_replace('/^Rp\.?\s*/i', '', $value);

        // Remove thousand separator (.)
        $value = str_replace('.', '', $value);

        // Replace decimal separator (,) with nothing (remove 2 digits behind comma)
        $value = str_replace(',', '', $value);

        // Remove trailing "-"
        $value = str_replace('-', '', $value);

        // Trim and convert to integer
        $value = trim($value);

        if ($value === '') {
            return null;
        }

        return (int) $value;
    }

    /**
     * Start importing from row 2 (skip header row)
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Map each row to a TertibPemanfaatan model
     */
    public function model(array $row)
    {
        // Map Excel columns to fields (1-indexed)
        // Kolom A = index 0, Kolom B = index 1, dst.
        // B = index 1 (waktu_survey)
        // C = index 2 (nama_paket)
        // H = index 7 (no_nib)
        // I = index 8 (no_sbu)
        // J = index 9 (nama_badan_usaha)
        // K = index 10 (nama_pimpinan)
        // L = index 11 (alamat)
        // M = index 12 (kab_kota)
        // N = index 13 (provinsi)
        // O = index 14 (no_telp)
        // P = index 15 (email)
        // Q = index 16 (npwp)
        // R = index 17 (jenis_usaha)
        // S = index 18 (sifat_usaha)
        // T = index 19 (no_reg_sbu)
        // U = index 20 (masa_berlaku_sbu)
        // V = index 21 (klasifikasi_usaha)
        // W = index 22 (kualifikasi_usaha)
        // X = index 23 (layanan_usaha)
        // Y = index 24 (url_file_nib)
        // Z = index 25 (url_file_sbu)
        // AA = index 26 (status_bpjs)
        // AB = index 27 (url_kwitansi)
        // AC = index 28 (instansi)

        $waktuSurvey = $this->convertExcelDate($this->getValue($row, 1));

        // Skip if waktu_survey is null or empty
        if ($waktuSurvey === null || $waktuSurvey === '') {
            return null;
        }

        return new TertibPemanfaatan([
            'waktu_survey' => $waktuSurvey,
            'nama_paket' => $this->getValue($row, 2),
            'nilai_kontrak' => $this->convertRupiah($this->getValue($row, 3)),
            'lama_pekerjaan' => $this->getValue($row, 4),
            'tanggal_mulai_kontrak' => $this->convertExcelDate($this->getValue($row, 5)),
            'tanggal_berakhit_kontrak' => $this->convertExcelDate($this->getValue($row, 6)),
            'no_nib' => $this->getValue($row, 7),
            'no_sbu' => $this->getValue($row, 8),
            'nama_badan_usaha' => $this->getValue($row, 9),
            'nama_pimpinan' => $this->getValue($row, 10),
            'alamat' => $this->getValue($row, 11),
            'kab_kota' => $this->getValue($row, 12),
            'provinsi' => $this->getValue($row, 13),
            'no_telp' => $this->getValue($row, 14),
            'email' => $this->getValue($row, 15),
            'npwp' => $this->getValue($row, 16),
            'jenis_usaha' => $this->getValue($row, 17),
            'sifat_usaha' => $this->getValue($row, 18),
            'no_reg_sbu' => $this->getValue($row, 19),
            'masa_berlaku_sbu' => $this->convertExcelDate($this->getValue($row, 20)),
            'klasifikasi_usaha' => $this->getValue($row, 21),
            'kualifikasi_usaha' => $this->getValue($row, 22),
            'layanan_usaha' => $this->getValue($row, 23),
            'url_file_nib' => $this->getValue($row, 24),
            'url_file_sbu' => $this->getValue($row, 25),
            'status_bpjs' => $this->getValue($row, 26),
            'url_kwitansi' => $this->getValue($row, 27),
            'instansi' => $this->getValue($row, 28),
        ]);
    }
}
