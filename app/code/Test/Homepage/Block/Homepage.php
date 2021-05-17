<?php


namespace Test\Homepage\Block;

use Lib\Tsg\Ssl\Api\Service\CheckOnlyAlloUrlByPatternInterface;
use Lib\Tsg\Ssl\Service\CheckOnlyAlloUrlByPattern;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Checkout\Model\Session;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\State;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Quote\Api\BillingAddressManagementInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\UrlRewrite\Model\UrlFinderInterface;
use Tsg\Catalog\Model\Category\Attribute\Backend\Urlkey;
use Tsg\Quote\Model\Quote;
use Tsg\Quote\Model\QuoteExtensionAttributes;
use Tsg\Quote\Model\ResourceModel\Quote\AddressExtensionAttributes;
use Tsg\QuoteApi\Model\Data\Quote\AddressExtensionAttributesInterface;
use Tsg\QuoteApi\Model\Data\QuoteExtensionAttributesInterface;
use Tsg\Review\Model\Rating\Total;
use Tsg\SeoApi\Service\ApplyQueryToUrlInterface;
use Tsg\Top\Model\Category\Attribute\Backend\Bannerleftlink;
use Tsg\Top\Model\Category\Attribute\Backend\Bannertoplink;

class Homepage extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function check()
    {

        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $objectManager = ObjectManager::getInstance();

        /** @var StoreManagerInterface $storeManager */
        $storeManager = $objectManager->get(StoreManagerInterface::class);
        /** @var ManagerInterface $eventManager */
        $eventManager = $objectManager->get(ManagerInterface::class);
        /** @var State $appState */
        $appState = $objectManager->get(State::class);


//        /** @var \Magento\Catalog\Controller\Category\View $categoryViewControllerAction */
//        $categoryViewControllerAction = $objectManager->get(\Magento\Catalog\Controller\Category\View::class);
//        /** @var \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository */
//        $categoryRepository = $objectManager->get(\Magento\Catalog\Api\CategoryRepositoryInterface::class);
//        $category = $categoryRepository->get(3);
//
//        $eventManager->dispatch('catalog_controller_category_init_after', [
//            'controller_action' => $categoryViewControllerAction,
//            'category' => $category
//        ]);


//        /** @var \Magento\CatalogInventory\Model\ResourceModel\Stock\Status $statusResource */
//        $statusResource = $objectManager->get(\Magento\CatalogInventory\Model\ResourceModel\Stock\Status::class);
//        /** @var ProductCollection $productCollection */
//        $productCollection = $objectManager->get(ProductCollection::class);
//        $productCollection->load();
//
//        $statusResource->addStockDataToCollection($productCollection, false);
//        $productCollection->addAttributeToSelect('*');
//        $productCollection->load();
//
//        echo "\n\n";
//        /** @var \Magento\Catalog\Api\Data\ProductInterface $product */
//        foreach ($productCollection->getItems() as $product) {
////            $output->writeln($product->getId() . ': ' . $product->getIsSalable2());
//
//            print_r($product->getData());
//            print_r($product->getSal());
//        }
//
//        exit;

//
//        /** @var Total $ratingTotal */
//        $ratingTotal = $objectManager->get(Total::class);
//        $ratingTotal->load(1);
//
//        echo $ratingTotal->getAvgValue();
//        exit;

//
//        /** @var \Lib\Tsg\PageUI\Header\UserConfig\Social $social */
//        $social = $objectManager->get(\Lib\Tsg\PageUI\Header\UserConfig\Social::class);
//        echo '<pre>';
//        print_r($social->getFields());
//        exit;

//        /** @var AddressExtensionAttributes $addressExtensionAttributesResource */
//        $addressExtensionAttributesResource = $objectManager->get(AddressExtensionAttributes::class);
//        /** @var Quote\AddressExtensionAttributes $addressExtensionAttributesModel */
//        $addressExtensionAttributesModel = $objectManager->get(Quote\AddressExtensionAttributes::class);
//        /** @var \Tsg\Quote\Model\ResourceModel\Quote\AddressExtensionAttributes\Collection $attributesCollection */
//        $attributesCollection = $objectManager->get(\Tsg\Quote\Model\ResourceModel\Quote\AddressExtensionAttributes\Collection::class);
//        /** @var \Magento\Quote\Model\ResourceModel\Quote\Address\Collection $quoteAddressCollection */
//        $quoteAddressCollection = $objectManager->get(\Magento\Quote\Model\ResourceModel\Quote\Address\Collection::class);
//        /** @var \Magento\Quote\Model\Quote\Address $quoteAddressModel */
//        $quoteAddressModel = $objectManager->get(\Magento\Quote\Model\Quote\Address::class);
//        /** @var \Magento\Quote\Model\ResourceModel\Quote\Address $quoteAddressResource */
//        $quoteAddressResource = $objectManager->get(\Magento\Quote\Model\ResourceModel\Quote\Address::class);
//        /** @var DataObjectProcessor $dataObjectProcessor */
//        $dataObjectProcessor = $objectManager->get(DataObjectProcessor::class);
//        /** @var CartRepositoryInterface $quoteRepository */
//        $quoteRepository = $objectManager->get(CartRepositoryInterface::class);
//        /** @var BillingAddressManagementInterface $billingAddressManagement */
//        $billingAddressManagement = $objectManager->get(BillingAddressManagementInterface::class);
//
////        $quote = $quoteRepository->get(2);
////        $quoteAddress = $quote->getBillingAddress();
////        $quoteAddress = $billingAddressManagement->get(2);
////        $addressExtensions = $quoteAddress->getExtensionAttributes();
////        echo $addressExtensions->getErpAddress();
//
////        echo '<pre>';
////        print_r($dataObjectProcessor->buildOutputDataArray($objectManager->get(Quote\AddressExtensionAttributes::class), AddressExtensionAttributesInterface::class));
////        exit;
//
//        $quoteAddressResource->load($quoteAddressModel, 2);
//
////        $quoteAddressModel->setHouse('New Test House');
////        $quoteAddressResource->save($quoteAddressModel);
//
//        $extensions = $quoteAddressModel->getExtensionAttributes();
//        echo 'ID: ' . $quoteAddressModel->getId() . '; City ID: ' . $extensions->getCityId() . '; ERP Address: ' . $extensions->getErpAddress() . '; House: ' . $extensions->getHouse() . '; Apartment: ' . $extensions->getApartment() . '<br>';
//
////        /** @var \Magento\Quote\Api\Data\AddressInterface $address */
////        foreach ($quoteAddressCollection as $address) {
////            $extensions = $address->getExtensionAttributes();
////            echo 'ID: ' . $address->getId() . '; City ID: ' . $extensions->getCityId() . '; ERP Address: ' . $extensions->getErpAddress() . '; House: ' . $extensions->getHouse() . '; Apartment: ' . $extensions->getApartment() . '<br>';
////        }
//
//
//        exit;
//
//        $urlKeyModel = $objectManager->get(Urlkey::class);
//        $urlKeyModel->validate();
//
//        echo 'done';
//        exit;

//        /** @var CartRepositoryInterface $cartRepository */
//        $cartRepository = $objectManager->get(CartRepositoryInterface::class);
//        /** @var SearchCriteriaInterface $searchCriteria */
//        $searchCriteria = $objectManager->get(SearchCriteriaInterface::class);
//        /** @var \Magento\Quote\Model\ResourceModel\Quote\Collection $quoteCollection */
//        $quoteCollection = $objectManager->get(\Magento\Quote\Model\ResourceModel\Quote\Collection::class);
//        /** @var \Tsg\Quote\Model\ResourceModel\QuoteExtensionAttributes\Collection $attributesCollection */
//        $attributesCollection = $objectManager->get(\Tsg\Quote\Model\ResourceModel\QuoteExtensionAttributes\Collection::class);
//        /** @var \Magento\Quote\Model\Quote $quoteModel */
//        $quote = $objectManager->get(\Magento\Quote\Model\Quote::class);
//        /** @var \Magento\Quote\Model\ResourceModel\Quote $quoteResource */
//        $quoteResource = $objectManager->get(\Magento\Quote\Model\ResourceModel\Quote::class);
//
////        $quoteResource->load($quote, 2);
////        $quoteResource->load($quote, 2);
//////        echo 'loaded via resource :D';
//////        exit;
////
////        $quote = $cartRepository->get(2);
////        $extensions = $quote->getExtensionAttributes();
////
////        echo 'get - ID: ' . $quote->getId() . '; Note: ' . $extensions->getNote() . '; Floor: ' . $extensions->getFloor() . '<br>';
////
////        exit;
////        $quoteList = $cartRepository->getList($searchCriteria);
//
//        foreach ($quoteCollection as $quote) {
//            $extensions = $quote->getExtensionAttributes();
//            echo 'ID: ' . $quote->getId() . '; Note: ' . $extensions->getNote() . '; Floor: ' . $extensions->getFloor() . '<br>';
//        }
//
//        exit;
    }
}
