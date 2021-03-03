<?php

namespace App\Library\Utils\File;

trait Export
{

    /**
     * Export to the given file format and download if requested
     *
     * @param $format
     * @param $fileName
     * @param $fileContent
     * @param bool $download
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse | null
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public static function exportTo($format, $fileName, $fileContent, $download = true)
    {
        $path = \Storage::disk(File::PRIVATE_STORAGE)->path('') . $fileName;

        switch (strtoupper($format)) {
            case "JSON":
                static::generateJSON($path, $fileContent);
                break;
            case "CSV":
                static::generateCSV($path, $fileContent);
                break;
            case "XLS":
                static::generateXLS($path, $fileContent);
                break;
            case "PDF":
                static::generatePDF($path, $fileContent);
                break;
            case "TXT":
            case "GEOJSON":
                static::generateGenericFile($path, $fileContent);
                break;
        }

        if ($download) {
            return File::download($path);
        }
        return null;
    }

    /**
     * Generate a JSON file
     *
     * @param $path
     * @param $data
     * @return string
     */
    private static function generateJSON($path, $data)
    {
        $handle = fopen($path, 'w');
        fwrite($handle, json_encode($data));
        fclose($handle);
        return $path;
    }

    /**
     * Generate a CSV file
     *
     * @param $path
     * @param $data
     * @return string
     */
    private static function generateCSV($path, $data)
    {
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

        return $path;
    }

    /**
     * Generate a XLS file
     *
     * @param $path
     * @param $data
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    private static function generateXLS($path, $data)
    {
        $columns = array_keys($data[0]);
        // Initialize XLS file
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0);
        // Append keys as first row
        $objPHPExcel->getActiveSheet()->fromArray($columns, null, 'A1');
        // Append row by row
        foreach ($data as $r => $record) {
            $values = array();
            foreach ($columns as $key) {
                $values[] = $record[$key];
            }
            $objPHPExcel->getActiveSheet()->fromArray($values, null, 'A' . ($r + 2));
        }
        $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        $objWriter->save($path);

        return $path;
    }

    /**
     * Generate a PDF file from HTML using Browsershot (Puppeteer)
     *
     * @param $path
     * @param $htmlContent
     * @return string
     */
    private static function generatePDF($path, $htmlContent)
    {
        \Spatie\Browsershot\Browsershot::html($htmlContent)
            ->emulateMedia('screen')
            ->showBackground()
            ->margins('10', '10', '10', '10')
            ->noSandbox()
            ->waitUntilNetworkIdle()
            ->ignoreHttpsErrors()
            ->save($path);
        return $path;
    }

    /**
     * Generate generic file
     *
     * @param $path
     * @param $data
     * @return string
     */
    private static function generateGenericFile($path, $data)
    {
        $handle = fopen($path, 'w');
        fwrite($handle, $data);
        fclose($handle);
        return $path;
    }

}
