<?php

function validateProdName( $inName ) {
	//cannot be empty
	
	if( empty($inName) ) {
		return false;	//Failed validation
	}
	else {
		return true;	//Passes validation	
	}	
}//end validateProdName()

function validateProdPrice( $inPrice) {
	//cannot be empty
	//must be numeric
	//must be greater than zero
	
	if( empty($inPrice) ) {
		return false;	//Failed validation
	}
	else {
		if( is_numeric($inPrice) && ($inPrice > 0) ){
			return true;		//Passes validation	
		}
		else {
			return false;	
		}
	}		
}//end validatePrice

function validateProdColor( $inColor) {
	//must select a color
	if( empty($inColor) ) {
		return false;
	}
	else {
		return true;	
	}
	
	
}//end validateProdColor()


function validateProdWagon( $inWagon ) {
	//must select a wagon
	if( $inWagon == "select" )	{
		return false;	
	}
	else {
		return true;	
	}
	
}//end validateProdSize()
?>