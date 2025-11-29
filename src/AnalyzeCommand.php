<?php
namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Filesystem\Filesystem;
use Carbon\Carbon;

class AnalyzeCommand extends Command
{
    protected static $defaultName = 'app:analyze';

    protected function configure()
    {
        $this->setDescription('Analisa um arquivo de texto.')
             ->addArgument('arquivo', InputArgument::REQUIRED, 'Caminho do arquivo');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fs = new Filesystem();
        $path = $input->getArgument('arquivo');

        if (!$fs->exists($path)) {
            $output->writeln('<error>Arquivo nao encontrado!</error>');
            return Command::FAILURE;
        }

        $content = file_get_contents($path);
        $words = str_word_count($content);
        $now = Carbon::now('America/Sao_Paulo')->isoFormat('LLLL');

        $output->writeln("=== RELATORIO ===");
        $output->writeln("Arquivo: " . $path);
        $output->writeln("Palavras: " . $words);
        $output->writeln("Data: " . $now);
        
        return Command::SUCCESS;
    }
}