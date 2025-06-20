<?php

namespace App\Services;

class OcrService
{
    public function processOCR($path)
    {
        $escapedPath = escapeshellarg($path);
        $command = "python " . base_path('python/ocr.py') . " " . $escapedPath;
        exec($command . " 2>&1", $outputArr, $returnCode);

        if ($returnCode !== 0) {
            throw new \RuntimeException("Failed to execute Python script: " . implode(PHP_EOL, $outputArr));
        }

        $outputText = $this->convertArrayToText($outputArr);

        return nl2br(trim($outputText));
    }

    private function convertArrayToText(array $outputArr): string
    {
        $output = '';

        foreach ($outputArr as $line) {
            if (is_string($line)) {
                $output .= trim($line) . " ";
            } elseif (is_array($line)) {
                $output .= implode("\n", array_map('trim', $line)) . " ";
            }
        }

        return $output;
    }
}
