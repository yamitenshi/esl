<?php
/**
 * Contains the URL's where Bucakroo should send a visitor after payment
 *
 * If a base url is provided the four required url's are auto-generated by appending a querystring to the base url where the status is put in the parameter 's'
 * With the appropriate setters one or more url's can be customized into something else
 *
 * @package Buckaroo
 * @version $Id: ReturnUrl.php 689 2014-04-17 11:37:08Z fpruis $
 */
class ESL_Buckaroo_ReturnUrl
{
	/**
	 *
	 * @var string
	 */
	protected $sUrlSuccess;

	/**
	 *
	 * @var string
	 */
	protected $sUrlCancel;

	/**
	 *
	 * @var string
	 */
	protected $sUrlError;

	/**
	 *
	 * @var string
	 */
	protected $sUrlReject;


	/**
	 *
	 * @var string
	 */
	protected $sUrlWaiting;

	/**
	 *
	 * @throws InvalidArgumentException
	 * 
	 * @param string $sBaseUrl Base URL used to generate the 4 status urls by appending a querystring
	 */
	public function __construct($sBaseUrl = null)
	{
		if ($sBaseUrl) {
			$this->assertAbsoluteUrl($sBaseUrl);
			if (strpos($sBaseUrl, '?')) {
				throw new InvalidArgumentException("Base URL may not contain a querystring.");
			} elseif (strpos($sBaseUrl, '#')) {
				throw new InvalidArgumentException("Base URL may not contain a hashtag.");
			}

			$this->setUrlSuccess($sBaseUrl . '?' . ESL_Buckaroo::QUERYSTRING_PUSHMESSAGE . '=' . urlencode(ESL_Buckaroo::STATUS_SUCCESS));
			$this->setUrlCancel($sBaseUrl . '?' . ESL_Buckaroo::QUERYSTRING_PUSHMESSAGE . '=' . urlencode(ESL_Buckaroo::STATUS_CANCEL));
			$this->setUrlError($sBaseUrl . '?' . ESL_Buckaroo::QUERYSTRING_PUSHMESSAGE . '=' . urlencode(ESL_Buckaroo::STATUS_ERROR));
			$this->setUrlReject($sBaseUrl . '?' . ESL_Buckaroo::QUERYSTRING_PUSHMESSAGE . '=' . urlencode(ESL_Buckaroo::STATUS_REJECT));
			
			// By default, the waiting-page is the same as the succespage. If for example you want to display payment-details for a backtransfer
			// you could use a custom waiting page. But you could also have buckaroo display this information for you
			$this->setUrlWaiting($sBaseUrl . '?' . ESL_Buckaroo::QUERYSTRING_PUSHMESSAGE . '=' . urlencode(ESL_Buckaroo::STATUS_SUCCESS));
		}
	}

	/**
	 *
	 * @param string $sUrl
	 */
	protected function assertAbsoluteUrl($sUrl)
	{
		$aUrl = parse_url($sUrl);
		if (!isset($aUrl['scheme'], $aUrl['host'], $aUrl['path'])) {
			throw new InvalidArgumentException("URL '$sUrl' is not an absolute url. Include a scheme, host and path.");
		}
	}

	/**
	 *
	 * @throws InvalidArgumentException
	 *
	 * @param string $sUrl Absolute URL to success page
	 */
	public function setUrlSuccess($sUrl)
	{
		$this->assertAbsoluteUrl($sUrl);
		$this->sUrlSuccess = $sUrl;
	}

	/**
	 *
	 * @return string
	 */
	public function getUrlSuccess()
	{
		if (null == $this->sUrlSuccess) {
			throw new RuntimeException('Success-URL has not been defined');
		}
		return $this->sUrlSuccess;
	}

	/**
	 *
	 * @throws InvalidArgumentException
	 *
	 * @param string $sUrl Absolute URL to cancel page
	 */
	public function setUrlCancel($sUrl)
	{
		$this->assertAbsoluteUrl($sUrl);
		$this->sUrlCancel = $sUrl;
	}

	/**
	 *
	 * @return string
	 */
	public function getUrlCancel()
	{
		if (null == $this->sUrlCancel) {
			throw new RuntimeException('Cancel-URL has not been defined');
		}
		return $this->sUrlCancel;
	}

	/**
	 *
	 * @throws InvalidArgumentException
	 *
	 * @param string $sUrl Absolute URL to error page
	 */
	public function setUrlError($sUrl)
	{
		$this->assertAbsoluteUrl($sUrl);
		$this->sUrlError = $sUrl;
	}

	/**
	 *
	 * @return string
	 */
	public function getUrlError()
	{
		if (null == $this->sUrlError) {
			throw new RuntimeException('Error-URL has not been defined');
		}
		return $this->sUrlError;
	}

	/**
	 *
	 * @throws InvalidArgumentException
	 *
	 * @param string $sUrl Absolute URL to reject page
	 */
	public function setUrlReject($sUrl)
	{
		$this->assertAbsoluteUrl($sUrl);
		$this->sUrlReject = $sUrl;
	}

	/**
	 *
	 * @return string
	 */
	public function getUrlReject()
	{
		if (null == $this->sUrlReject) {
			throw new RuntimeException('Reject-URL has not been defined');
		}
		return $this->sUrlReject;
	}

	/**
	 *
	 * @throws InvalidArgumentException
	 *
	 * @param string $sUrl Absolute URL to reject page
	 */
	public function setUrlWaiting($sUrl)
	{
		$this->assertAbsoluteUrl($sUrl);
		$this->sUrlWaiting = $sUrl;
	}

	/**
	 *
	 * @return string
	 */
	public function getUrlWaiting()
	{
		if (null == $this->sUrlWaiting) {
			throw new RuntimeException('Waiting-URL has not been defined');
		}
		return $this->sUrlWaiting;
	}

}
?>