<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;

class DeployController extends Controller
{
    public function pullCode()
    {
        $branch = 'development';

        $path = base_path();

        $process = new Process(['git', 'pull']);
        $process->setWorkingDirectory($path);
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json([
                'status' => 'error',
                'output' => $process->getErrorOutput()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'output' => $process->getOutput()
        ]);
    }
}
