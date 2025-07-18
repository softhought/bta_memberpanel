<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;

class DeployController extends Controller
{
    public function pullCode()
    {
        $repoPath = base_path();
        echo $repoPath;exit;
        $keyPath = storage_path('ssh/bta');

        $process = Process::fromShellCommandline(
            'git pull',
            $repoPath
        );

        $process->run();

        if ($process->isSuccessful()) {
            echo "Git pulled successfully: " . $process->getOutput();
        } else {
            echo "Git pull failed: " . $process->getErrorOutput();
        }
    }
}
