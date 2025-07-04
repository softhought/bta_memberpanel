<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;

class DeployController extends Controller
{
    public function pullCode()
    {
        $repoPath = base_path();
        $keyPath = storage_path('ssh/bta');

        $process = Process::fromShellCommandline(
            'GIT_SSH_COMMAND="ssh -i ' . $keyPath . ' -o StrictHostKeyChecking=no" git reset --hard origin/development',
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
