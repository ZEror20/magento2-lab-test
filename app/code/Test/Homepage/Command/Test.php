<?php

namespace Test\Homepage\Command;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\State;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tsg\DbApi\Service\Adapter\Pdo\Mysql\GetConnectionInterface;

class Test extends Command
{
    protected function configure()
    {
        $this->setName('tsg:local:test');
        $this->setDescription('Tsg Test Command');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $objectManager = ObjectManager::getInstance();

        /** @var StoreManagerInterface $storeManager */
        $storeManager = $objectManager->get(StoreManagerInterface::class);
        /** @var ManagerInterface $eventManager */
        $eventManager = $objectManager->get(ManagerInterface::class);
        /** @var State $appState */
        $appState = $objectManager->get(State::class);
//        $appState->setAreaCode(Area::AREA_FRONTEND);



//        /** @var CronRunner $cronRunner */
//        $cronRunner = $objectManager->get(CronRunner::class);
//        /** @var ResourceConnection $resourceConnection */
//        $resourceConnection = $objectManager->get(ResourceConnection::class);
//        /** @var UseSlaveConnectionAdapterInterface $useSlaveConnectionAdapter */
//        $useSlaveConnectionAdapter = $objectManager->get(UseSlaveConnectionAdapterInterface::class);
//
//        $useSlaveConnectionAdapter->enable();
//        $connection = $resourceConnection->getConnection();
//        $result = $connection->fetchAll('SELECT * FROM `dev_allo_func_test`.`tsg_feedback`');



//        $output->writeln($cronRunner->getCronByAlias('customer_alias'));

//        /** @var GetConnectionByCronAliasInterface $getConnectionByCronAlias */
//        $getConnectionByCronAlias = $objectManager->get(GetConnectionByCronAliasInterface::class);
//
//        $output->writeln($getConnectionByCronAlias->execute());


        /** @var GetConnectionInterface $getConnection */
        $getConnection = $objectManager->get(GetConnectionInterface::class);
        $result = $getConnection->execute();

        $output->writeln('The end.');
    }
}
