<?php

$customer_name = "";

$customer_ssn = "";

$customer_response = "";

$customerErrorName = "";

$customerErrorSSN = "";

$customerErrorResponse = "";

$validForm = false;

$message = "";

if(isset($_POST["submit"]))

{

	$customer_name = $_POST['customer_name'];

	$customer_ssn = $_POST['customer_ssn'];

	$customer_response = $_POST['customer_response'];

	$validForm = true;

	function validateCustomerName($in) {

        global $validForm, $customerErrorName;

        $customerErrorName = "";



        if($in == "")

        {

            $validForm = false;

            $customerErrorName = "Name field cannot be empty";

        }

    }



    function validateCustomerSSN($ssn)

    {

        global $validForm, $customerErrorSSN;

        $ssn_validate = str_replace('-', '', $ssn);

        $pattern = '/^[0-9]{9}$/';

        if(!preg_match($pattern,$ssn_validate))

        {

            if($ssn_validate > 9)

            {

                $validForm = false;

                $customerErrorSSN = "The SSN you entered isn't valid";

            }

		$validForm = false;

        }

        if($ssn == "")

        {

            $customerErrorSSN = "SSN field cannot be empty";

        }

    }

    function validateCustomerResponse($response)

    {

        global $validForm, $customerErrorResponse;

        if(!isset($response))

        {

            $validForm = false;

            $customerErrorResponse = "Please select at least one button";

        }

    }



	validateCustomerName($customer_name);

	validateCustomerSSN($customer_ssn);

	validateCustomerResponse($customer_response);



	if($validForm)

	{

		try {

			require 'connectionServer.php';

			$date = date("Y-m-d");



			$sql = "INSERT INTO wdv341_registration (customer_name, customer_ssn, customer_response) VALUES (:customerName, :customerSSN, :customerResponse)";

			$stmt = $conn->prepare($sql);

			$stmt->bindParam(':customerName',$customer_name);

			$stmt->bindParam(':customerSSN',$customer_ssn);

			$stmt->bindParam(':customerResponse',$customer_response);

			$stmt->execute();

			$message = "Thank you very much, we've received your response";

		}

		catch(PDOException $e)

		{

			$message = "There has been a problem. Support has been contacted.";



			error_log($e->getMessage());

			error_log(var_dump(debug_backtrace()));

		}

	}

	else {

		$message = "Something went wrong.";

	}

}

else {



}

?>

<!DOCTYPE html>

<html >

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>WDV341 Intro PHP - Form Validation Example</title>

<style>



#orderArea	{

	width:600px;

	background-color:#CF9;

}



.error	{

	color:red;

	font-style:italic;	

}

</style>

</head>



<body>

<h1>WDV341 Intro PHP</h1>

<h2>Form Validation Assignment





</h2>

<div id="orderArea">

	  <?php

		if($validForm)

		{

	  ?>

      <td class="success"><?php echo $message ?></td>

	  <?php

		}

		else

		{

			

	   ?>

  <form id="form1" name="form1" method="post" action="formValidationAssignment.php">

  <h3>Customer Registration Form</h3>

  <table width="587" border="0">

    <tr>

      <td width="117">Name:</td>

      <td width="246"><input type="text" name="customer_name" id="inName" size="40" value="<?php echo $customer_name ?>"/></td>

      <td width="210" class="error"> <?php echo $customerErrorName ?></td>

    </tr>

    <tr>

      <td>Social Security</td>

      <td><input type="text" name="customer_ssn" id="inEmail" size="40" value="<?php echo $customer_ssn ?>" /></td>

      <td class="error"> <?php echo $customerErrorSSN ?></td>

    </tr>

    <tr>

      <td>Choose a Response</td>

      <td><p>

        <label>
        
          <input type="radio" name="customer_response" id="RadioGroup1_0" value="phone" <?php if($customer_response == "phone") echo "checked='checked'"; ?>>
          Phone</label>

        <br>

        <label>

          <input type="radio" name="customer_response" id="RadioGroup1_1" value="email" <?php if($customer_response == "email") echo "checked='checked'"; ?>>

          Email</label>

        <br>

        <label>

          <input type="radio" name="customer_response" id="RadioGroup1_2" value="US mail" <?php if($customer_response == "US mail") echo "checked='checked'"; ?>>

          US Mail</label>

        <br>

      </p></td>

	  <td class="error"> <?php echo $customerErrorResponse ?> </td>

    </tr>

  </table>

  <p>

    <input type="submit" name="submit" id="button" value="Register" />

    <input type="reset" name="button2" id="button2" value="Clear Form" />

  </p>

</form>

		<?php 

		} 

		?>

</div>



</body>

</html>