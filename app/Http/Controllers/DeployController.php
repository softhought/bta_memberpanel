<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;

class DeployController extends Controller
{
    public function pullCode()
    {
        $branch = 'development';
        $path = base_path();

        // Tell Git to use a specific SSH key
        $sshCommand = "ssh -i /usr/share/httpd/bta/.ssh/id_rsa -o StrictHostKeyChecking=no";

        // Set GIT_SSH_COMMAND so it uses the custom key
        $process = Process::fromShellCommandline("git pull origin $branch", $path, [
            'GIT_SSH_COMMAND' => $sshCommand,
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json([
                'status' => 'error',
                'output' => $process->getErrorOutput(),
                'process' => null
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'output' => $process->getOutput()
        ]);
    }
}
