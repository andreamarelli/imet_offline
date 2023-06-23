<?php

namespace AndreaMarelli\ModularForms\Helpers\File;

use PhpOffice\PhpSpreadsheet;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

trait Export
{

    /**
     * Generate a JSON file
     *
     * @param $path
     * @param $data
     * @param bool $download
     * @return string|BinaryFileResponse
     */
    public static function exportToJSON($path, $data, bool $download = true)
    {
        $path = Storage::disk(File::TEMP_STORAGE)->path('') . $path;

        $handle = fopen($path, 'w');
        fwrite($handle, json_encode($data));
        fclose($handle);

        return $download
            ? File::download($path)
            : $path;
    }

    /**
     * Generate a CSV file
     *
     * @param $path
     * @param $data
     * @return BinaryFileResponse
     */
    public static function exportToCSV($path, $data): BinaryFileResponse
    {
        $path = Storage::disk(File::TEMP_STORAGE)->path('') . $path;

        // Append keys as first row
        array_unshift($data, array_keys($data[0]));
        // Append row by row
        $file_handler = fopen($path, 'w');
        fprintf($file_handler, chr(0xEF) . chr(0xBB) . chr(0xBF));
        foreach ($data as $row) {
            foreach ($row as $field_index => $field){
                // convert to string eventual array $fields (ex. from checkboxes)
                $row[$field_index] = is_array($field) ? implode(';', $field) : $field;
            }
            fputcsv($file_handler, $row);
        }
        fclose($file_handler);

        return File::download($path);
    }

    /**
     * Generate a XLS file
     *
     * @param $path
     * @param $data
     * @return BinaryFileResponse
     * @throws PhpSpreadsheet\Exception
     * @throws PhpSpreadsheet\Writer\Exception
     */
    public static function exportToXLS($path, $data): BinaryFileResponse
    {
        $path = Storage::disk(File::TEMP_STORAGE)->path('') . $path;

        $columns = array_keys($data[0]);
        // Initialize XLS file
        $objPHPExcel = new PhpSpreadsheet\Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0);
        // Append keys as first row
        $objPHPExcel->getActiveSheet()->fromArray($columns);
        // Append row by row
        foreach ($data as $r => $record) {
            $values = array();
            foreach ($columns as $key) {
                $values[] = $record[$key];
            }
            $objPHPExcel->getActiveSheet()->fromArray($values, null, 'A' . ($r + 2));
        }
        $objWriter = new PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        $objWriter->save($path);

        return File::download($path);
    }

    /**
     * Generate a GeoJSON file
     *
     * @param $path
     * @param $data
     * @return BinaryFileResponse
     */
    public static function exportToGeoJSON($path, $data): BinaryFileResponse
    {
        $path = Storage::disk(File::TEMP_STORAGE)->path('') . $path;

        $handle = fopen($path, 'w');
        fwrite($handle, $data);
        fclose($handle);

        return File::download($path);
    }

}
