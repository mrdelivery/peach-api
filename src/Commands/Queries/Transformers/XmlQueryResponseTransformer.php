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

class XmlQueryResponseTransformer implements QueryResponseTransformer
{
    public function transform(ResponseInterface $response)
    {
        $xml = $response->xml();

        if (!empty($xml->Error)) {
            $timestamp = (string) $xml->Error->Timestamp;
            $returnCode = (string) $xml->Error->Return->attributes()['code'];
            $message = (string) $xml->Error->Return;

            return Response::makeError(
                new ResponseError($timestamp, $returnCode, $message)
            );
        }

        $transactions = [];
        foreach ($xml->Result->Transaction as $xmlTransaction) {
            $identification = $this->parseIdentification($xmlTransaction);
            $payment = $this->parsePayment($xmlTransaction);
            $account = $this->parseAccount($xmlTransaction);
            $customer = $this->parseCustomer($xmlTransaction);
            $processing = $this->parseProcessing($xmlTransaction);

            $mode = (string) $xmlTransaction->attributes()['mode'];
            $channel = (string) $xmlTransaction->attributes()['channel'];
            $response = (string) $xmlTransaction->attributes()['response'];
            $source = (string) $xmlTransaction->attributes()['source'];

            $transactions[] = new Transaction(
                $mode, $channel, $response, $source, $identification, $payment, $account, $customer, $processing
            );
        }

        $resultResponse = (string) $xml->Result->attributes()['response'];
        $resultType = (string) $xml->Result->attributes()['type'];
        $result = new Result($resultResponse, $resultType, $transactions);

        return Response::makeResult($result);
    }

    /**
     * @param \SimpleXMLElement $xmlTransaction
     * @return \Mnel\Peach\Query\Response\Results\Identification
     */
    protected function parseIdentification($xmlTransaction)
    {
        $shortId = (string) $xmlTransaction->Identification->ShortID;
        $uniqueId = (string) $xmlTransaction->Identification->UniqueID;
        $transactionId = (string) $xmlTransaction->Identification->TransactionID;
        $bulkId = (string) $xmlTransaction->Identification->BulkID;
        $invoiceId = (string) $xmlTransaction->Identification->InvoiceID;
        return new Identification($shortId, $uniqueId, $transactionId, $bulkId, $invoiceId);
    }

    /**
     * @param \SimpleXMLElement $xmlTransaction
     * @return \Mnel\Peach\Query\Response\Results\Payments\Payment
     */
    protected function parsePayment($xmlTransaction)
    {
        $clrAmount = (string) $xmlTransaction->Payment->Clearing->Amount;
        $clrCurrency = (string) $xmlTransaction->Payment->Clearing->Currency;
        $clrDescriptor = (string) $xmlTransaction->Payment->Clearing->Descriptor;
        $clrFxRate = (string) $xmlTransaction->Payment->Clearing->FxRate;
        $clrFxSource = (string) $xmlTransaction->Payment->Clearing->FxSource;
        $clrFxDate = (string) $xmlTransaction->Payment->Clearing->FxDate;
        $clearing = new Clearing($clrAmount, $clrCurrency, $clrDescriptor, $clrFxRate, $clrFxSource, $clrFxDate);

        $prsAmount = (string) $xmlTransaction->Payment->Presentation->Amount;
        $prsCurrency = (string) $xmlTransaction->Payment->Presentation->Currency;
        $presentation = new Presentation($prsAmount, $prsCurrency);

        $code = (string) $xmlTransaction->Payment->attributes()['code'];

        return new Payment($code, $clearing, $presentation);
    }

    /**
     * @param \SimpleXMLElement $xmlTransaction
     * @return \Mnel\Peach\Query\Response\Results\Account
     */
    protected function parseAccount($xmlTransaction)
    {
        $number = (string) $xmlTransaction->Account->Number;
        $holder = (string) $xmlTransaction->Account->Holder;
        $brand = (string) $xmlTransaction->Account->Brand;
        $month = (int) $xmlTransaction->Account->Month;
        $year = (int) $xmlTransaction->Account->Year;
        $expiry = $xmlTransaction->Account->Expiry->attributes();
        $expiryMonth = (int) $expiry['month'];
        $expiryYear = (int) $expiry['year'];
        $registrationId = (string) $xmlTransaction->Account->RegistrationId;

        return new Account($number, $holder, $brand, $month, $year, $registrationId, $expiryMonth, $expiryYear);
    }

    /**
     * @param \SimpleXMLElement $xmlTransaction
     * @return Customer
     */
    protected function parseCustomer($xmlTransaction)
    {
        $street = (string) $xmlTransaction->Customer->Address->Street;
        $city = (string) $xmlTransaction->Customer->Address->City;
        $state = (string) $xmlTransaction->Customer->Address->State;
        $country = (string) $xmlTransaction->Customer->Address->Country;
        $zip = (string) $xmlTransaction->Customer->Address->Zip;
        $address = new CustomerAddress($street, $city, $state, $country, $zip);

        $email = (string) $xmlTransaction->Customer->Contact->Email;
        $ip = (string) $xmlTransaction->Customer->Contact->Ip;
        $mobile = (string) $xmlTransaction->Customer->Contact->Mobile;
        $phone = (string) $xmlTransaction->Customer->Contact->Phone;
        $contact = new CustomerContact($email, $ip, $mobile, $phone);

        $family = (string) $xmlTransaction->Customer->Name->Family;
        $given = (string) $xmlTransaction->Customer->Name->Given;
        $salutation = (string) $xmlTransaction->Customer->Name->Salutation;
        $name = new CustomerName($family, $given, $salutation);

        return new Customer($address, $contact, $name);
    }

    /**
     * @param \SimpleXMLElement $xmlTransaction
     * @return \Mnel\Peach\Query\Response\Results\Processing
     */
    protected function parseProcessing($xmlTransaction)
    {
        $code = (string) $xmlTransaction->Processing->attributes()['code'];
        $timestamp = (string) $xmlTransaction->Processing->Timestamp;
        $result = (string) $xmlTransaction->Processing->Result;
        $status = (string) $xmlTransaction->Processing->Status;
        $statusCode = (string) $xmlTransaction->Processing->Status->attributes()['code'];
        $reason = (string) $xmlTransaction->Processing->Reason;
        $reasonCode = (string) $xmlTransaction->Processing->Reason->attributes()['code'];
        $return = (string) $xmlTransaction->Processing->Return;
        $returnCode = (string) $xmlTransaction->Processing->Return->attributes()['code'];
        $connectorTxId = (string) $xmlTransaction->Processing->ConnectorTxId;

        return new Processing(
            $code, $timestamp, $result, $status, $statusCode, $reason, $reasonCode, $return, $returnCode, $connectorTxId
        );
    }
}
