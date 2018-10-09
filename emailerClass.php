<?php
class Mailer
{
	private $mailer;
	private $receiver;
	private $subject;
	private $message;

	function __construct($mailer, $receiver, $subject, $message)
	{
		$this->mailer = $mailer;
		$this->receiver = $receiver;
		$this->subject = $subject;
		$this->message = $message;
	}
	public function setMailer($mailer)
	{
		$this->mailer = $mailer;
	}
	public function getMailer()
	{
		return $this->mailer;
	}
	public function setReceiver($receiver)
	{
		$this->receiver = $receiver;
	}
	public function getReceiver()
	{
		return $this->receiver;
	}
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
	public function getSubject()
	{
		return $this->subject;
	}
	public function setMessage($message)
	{
		$this->message = $message;
	}
	public function getMessage()
	{
		return $this->message;
	}

	public function emailPerson()
	{
		$wrap = wordwrap($this->message,30,"<br>\n");
		$result = mail($this->receiver, $this->subject, $wrap, "From: {$this->mailer}\r\n");

		if($result)
		{
			echo "<p> Email has been sent to {$this->receiver} </p>";
			echo $wrap;
		}
		else {
			echo "Mail was unsuccessfully sent to {$this->receiver}";
		}

	}
}
?>