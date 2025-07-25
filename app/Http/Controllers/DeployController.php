<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;

class DeployController extends Controller
{
    public function pullCode()
    {
        $repoPath = "/var/www/html/members-btaportal-in";
        if (!is_dir($repoPath . '/.git')) {
            echo "Error: Not a git repository at {$repoPath}";
            return;
        }

        $keyPath = storage_path('ssh/bta');

        $process = Process::fromShellCommandline(
            'GIT_SSH_COMMAND="ssh -i ' . $keyPath . ' -o StrictHostKeyChecking=no" git pull',
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
