<?php namespace Mnel\Peach\Commands\Queries\Transformers;

use Mnel\Peach\Commands\Queries\QueryRequestTransformer;
use Mnel\Peach\Query\Request\Criteria\Identification;
use Mnel\Peach\Query\Request\QueryRequest;
use SimpleXMLElement;

class XmlQueryRequestTransformer implements QueryRequestTransformer
{
    public function transform(QueryRequest $request)
    {
        $root = sprintf('<Request version="%s"></Request>', $request->getVersion());
        $xmlRequest = new SimpleXMLElement($root);

        $xmlRequest->addChild('Header');
        $xmlRequest->Header->addChild('Security');
        $xmlRequest->Header->Security->addAttribute('sender', $request->getHeader()->getSender());

        $xmlRequest->addChild('Query');
        $xmlRequest->Query->addAttribute('mode', $request->getQuery()->getMode());
        $xmlRequest->Query->addAttribute('level', $request->getQuery()->getLevel());
        $xmlRequest->Query->addAttribute('type', $request->getQuery()->getType());
        $xmlRequest->Query->addAttribute('entity', $request->getQuery()->getEntity());

        $xmlRequest->Query->addChild('User');
        $xmlRequest->Query->User->addAttribute('login', $request->getQuery()->getUser()->getLogin());
        $xmlRequest->Query->User->addAttribute('pwd', $request->getQuery()->getUser()->getPassword());

        $xmlRequest->Query->addChild('Period');
        $xmlRequest->Query->Period->addAttribute('from', $request->getQuery()->getPeriod()->getFrom());
        $xmlRequest->Query->Period->addAttribute('to', $request->getQuery()->getPeriod()->getTo());

        if ($identification = $request->getQuery()->getIdentification()) {
            $this->setIdentification($identification, $xmlRequest);
        }

        if ($transactionType = $request->getQuery()->getTransactionType()) {
            $xmlRequest->Query->addChild('TransactionType', $transactionType);
        }

        $paymentMethods = $request->getQuery()->getPaymentMethods();
        if (!empty($paymentMethods)) {
            $this->setPaymentMethods($xmlRequest, $paymentMethods);
        }

        $paymentTypes = $request->getQuery()->getPaymentTypes();
        if (!empty($paymentTypes)) {
            $this->setPaymentTypes($xmlRequest, $paymentTypes);
        }

        if ($processingResult = $request->getQuery()->getProcessingResult()) {
            $xmlRequest->Query->addChild('ProcessingResult', $processingResult);
        }

        if ($account = $request->getQuery()->getAccount()) {
            $this->setAccount($account, $xmlRequest);
        }
//        dd(htmlentities($xmlRequest->asXML()));

        return [ 'load' => $xmlRequest->asXML() ];
    }

    /**
     * @param Identification   $identification
     * @param SimpleXMLElement $xmlRequest
     * @internal param Request $request
     */
    protected function setIdentification(Identification $identification, SimpleXMLElement $xmlRequest)
    {
        $xmlRequest->Query->addChild('Identification');

        if (!empty($identification->getUniqueIDs())) {
            $xmlRequest->Query->Identification->addChild('UniqueIDs');
            foreach ($identification->getUniqueIDs() as $uniqueID) {
                $xmlRequest->Query->Identification->UniqueIDs->addChild('ID', $uniqueID);
            }
        }

        if ($shortId = $identification->getShortId()) {
            $xmlRequest->Query->Identification->addChild('ShortID', $shortId);
        }

        if ($transactionId = $identification->getTransactionId()) {
            $xmlRequest->Query->Identification->addChild('TransactionID', $transactionId);
        }
    }

    /**
     * @param $xmlRequest
     * @param $account
     */
    protected function setAccount($xmlRequest, $account)
    {
        $xmlRequest->Query->addChild('Account');
        $xmlRequest->Query->Account->addChild('Id', $account->getId());
        $xmlRequest->Query->Account->addChild('Password', $account->getPassword());
        $xmlRequest->Query->Account->addChild('Brand', $account->getBrand());
    }

    /**
     * @param $xmlRequest
     * @param $paymentMethods
     */
    protected function setPaymentMethods($xmlRequest, $paymentMethods)
    {
        $xmlRequest->Query->addChild('Methods');
        foreach ($paymentMethods as $paymentMethod) {
            $xmlRequest->Query->Methods->addChild('Method', $paymentMethod);
        }
    }

    /**
     * @param SimpleXMLElement $xmlRequest
     * @param array            $paymentTypes
     */
    protected function setPaymentTypes(\SimpleXMLElement $xmlRequest, array $paymentTypes)
    {
        $xmlRequest->Query->addChild('Types');
        foreach ($paymentTypes as $paymentType) {
            $xmlRequest->Query->Types->addChild('Type')->addAttribute('code', $paymentType);
        }
    }
}
