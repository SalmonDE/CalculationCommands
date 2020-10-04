<?php
declare(strict_types = 1);

namespace SalmonDE\CalculationCommands\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use SalmonDE\CalculationCommands\Loader;

abstract class CalculationCommand extends Command implements PluginOwned {

	private $owningPlugin;

    public function __construct(string $cmdName, Loader $plugin){
        parent::__construct($cmdName, 'calculation command');
		$this->owningPlugin = $plugin;
    }

    final protected function parseParams(array &$params): void{
        $parsedParams = [];
        foreach($params as $key => $param){
            $param = str_replace(',', '.', preg_replace('/[^0-9.,-]/', '', $param));
            if(is_numeric($param)){
                if(ctype_digit($param)){
                    $parsedParams[] = (int) $param;
                }else{
                    $parsedParams[] = (float) $param;
                }
            }
        }

        $params = $parsedParams;
    }

	public function execute(CommandSender $sender, string $label, array $args){
		if(!$this->owningPlugin->isEnabled()){
    		return false;
		}

		if(!$this->testPermission($sender)){
    		return false;
		}

		if(!$this->onCommand($sender, $label, $args)){
			throw new InvalidCommandSyntaxException();
		}

		return true;
	}

	abstract protected function onCommand(CommandSender $sender, string $label, array $args): bool;

	public function getOwningPlugin(): Plugin{
		return $this->owningPlugin;
	}
}
