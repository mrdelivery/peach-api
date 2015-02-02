<?php namespace Mnel\Peach\Commands\Queries\Transformers;

use GuzzleHttp\Message\ResponseInterface;
use Mnel\Peach\Commands\Queries\QueryResponseTransformer;
use Mnel\Peach\Query\Response\Response;
use Mnel\Peach\Query\Response\ResponseError;
use Mnel\Peach\Query\Response\Result;
use Mnel\Peach\Query\Response\Results\Account;
use Mnel\Peach\Query\Response\Results\Customers\Customer;
use Mnel\Peach\Query\Response\Results\Customers\CustomerAddress;
use Mnel\Peach\Query\Response\Results\Customers\CustomerContact;
use Mnel\Peach\Query\Response\Results\Customers\CustomerName;
use Mnel\Peach\Query\Response\Results\Identification;
use Mnel\Peach\Query\Response\Results\Payments\Clearing;
use Mnel\Peach\Query\Response\Results\Payments\Payment;
use Mnel\Peach\Query\Response\Results\Payments\Presentation;
use Mnel\Peach\Query\Response\Results\Processing;
use Mnel\Peach\Query\Response\Results\Transaction;
use SimpleXMLElement;

class XmlQueryResponseTransformer implements QueryResponseTransformer
{
    public function transform($response)
    {
        $xml = new SimpleXMLElement($response);

        if (!empty($xml->Error)) {
            $timestamp = (string) $xml->Error->Timestamp;
            $returnCode = (string) $xml->Error->Return->attributes()['code'];
            $message = (string) $xml->Error->Return;

            return Response::makeError(
                $response,
                new ResponseError($timestamp, $returnCode, $message)
            );
        }

        $transactions = [];
        foreach ($xml->Result->Transaction as $xmlTransaction) {
            $identification = $this->parseIdentification($xmlTransaction);
            $payment = $this->parsePayment($xmlTransaction);
            $processing = $this->parseProcessing($xmlTransaction);

            $mode = (string) $xmlTransaction->attributes()['mode'];
            $channel = (string) $xmlTransaction->attributes()['channel'];
            $response = (string) $xmlTransaction->attributes()['response'];
            $source = (string) $xmlTransaction->attributes()['source'];

            $transaction = new Transaction(
                $mode, $channel, $response, $source, $identification, $payment, $processing
            );

            if ($account = $this->parseAccount($xmlTransaction)) {
                $transaction->setAccount($account);
            }

            if ($customer = $this->parseCustomer($xmlTransaction)) {
                $transaction->setCustomer($customer);
            }

            $transactions[] = $transaction;
        }

        $resultResponse = (string) $xml->Result->attributes()['response'];
        $resultType = (string) $xml->Result->attributes()['type'];
        $result = new Result($resultResponse, $resultType, $transactions);

        return Response::makeResult($response, $result);
    }

    /**
     * @param SimpleXMLElement $xmlTransaction
     * @return \Mnel\Peach\Query\Response\Results\Identification
     */
    protected function parseIdentification($xmlTransaction)
    {
        return new Identification(
            (string) $xmlTransaction->Identification->ShortID,
            (string) $xmlTransaction->Identification->UniqueID,
            (string) $xmlTransaction->Identification->TransactionID,
            (string) $xmlTransaction->Identification->BulkID,
            (string) $xmlTransaction->Identification->InvoiceID
        );
    }

    /**
     * @param SimpleXMLElement $xmlTransaction
     * @return \Mnel\Peach\Query\Response\Results\Payments\Payment
     */
    protected function parsePayment($xmlTransaction)
    {
        $clearing = new Clearing(
            (string) $xmlTransaction->Payment->Clearing->Amount,
            (string) $xmlTransaction->Payment->Clearing->Currency,
            (string) $xmlTransaction->Payment->Clearing->Descriptor,
            (string) $xmlTransaction->Payment->Clearing->FxRate,
            (string) $xmlTransaction->Payment->Clearing->FxSource,
            (string) $xmlTransaction->Payment->Clearing->FxDate
        );

        $presentation = new Presentation(
            (string) $xmlTransaction->Payment->Presentation->Amount,
            (string) $xmlTransaction->Payment->Presentation->Currency
        );

        $code = (string) $xmlTransaction->Payment->attributes()['code'];

        return new Payment($code, $clearing, $presentation);
    }

    /**
     * @param SimpleXMLElement $xmlTransaction
     * @return \Mnel\Peach\Query\Response\Results\Account
     */
    protected function parseAccount($xmlTransaction)
    {
        if (empty($xmlTransaction->Account)) {
            return null;
        }

        $expiry = null;
        if ($xmlTransaction->Account->Expiry && $xmlTransaction->Account->Expiry->attributes()) {
            $expiry = $xmlTransaction->Account->Expiry->attributes();
        }

        return new Account(
            (string) $xmlTransaction->Account->Number,
            (string) $xmlTransaction->Account->Holder,
            (string) $xmlTransaction->Account->Brand,
            (int) $xmlTransaction->Account->Month,
            (int) $xmlTransaction->Account->Year,
            (string) $xmlTransaction->Account->RegistrationId,
            is_null($expiry) ? null : (int) $expiry['month'],
            is_null($expiry) ? null : (int) $expiry['year']
        );
    }

    /**
     * @param SimpleXMLElement $xmlTransaction
     * @return Customer
     */
    protected function parseCustomer($xmlTransaction)
    {
        if (empty($xmlTransaction->Customer)) {
            return null;
        }

        $address = new CustomerAddress(
            (string) $xmlTransaction->Customer->Address->Street,
            (string) $xmlTransaction->Customer->Address->City,
            (string) $xmlTransaction->Customer->Address->State,
            (string) $xmlTransaction->Customer->Address->Country,
            (string) $xmlTransaction->Customer->Address->Zip
        );

        $contact = new CustomerContact(
            (string) $xmlTransaction->Customer->Contact->Email,
            (string) $xmlTransaction->Customer->Contact->Ip,
            (string) $xmlTransaction->Customer->Contact->Mobile,
            (string) $xmlTransaction->Customer->Contact->Phone
        );

        $name = new CustomerName(
            (string) $xmlTransaction->Customer->Name->Family,
            (string) $xmlTransaction->Customer->Name->Given,
            (string) $xmlTransaction->Customer->Name->Salutation
        );

        return new Customer($address, $contact, $name);
    }

    /**
     * @param SimpleXMLElement $xmlTransaction
     * @return \Mnel\Peach\Query\Response\Results\Processing
     */
    protected function parseProcessing($xmlTransaction)
    {
        return new Processing(
            (string) $xmlTransaction->Processing->attributes()['code'],
            (string) $xmlTransaction->Processing->Timestamp,
            (string) $xmlTransaction->Processing->Result,
            (string) $xmlTransaction->Processing->Status,
            (string) $xmlTransaction->Processing->Status->attributes()['code'],
            (string) $xmlTransaction->Processing->Reason,
            (string) $xmlTransaction->Processing->Reason->attributes()['code'],
            (string) $xmlTransaction->Processing->Return,
            (string) $xmlTransaction->Processing->Return->attributes()['code'],
            (string) $xmlTransaction->Processing->ConnectorTxId
        );
    }
}
