<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DeployController extends Controller
{
    public function pullCode()
    {
        $branch = 'development';

        $path = base_path();

        $output = shell_exec('eval "$(ssh-agent -s)" > /dev/null ssh-add ~/.ssh/bta 2>/dev/null');
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
            'output' => $process->getOutput(),
            'process' => $output
        ]);
    }
}
