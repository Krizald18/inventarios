<?php 

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

/**
 * It's important to extend the Validator class. By doing that we make sure we
 * keep all the other rules as well! Now if you want to override a rule you can
 * do that here as well. For now we will only focus on creating rules.
 */
class CustomValidation extends Validator {
	/**
	 * Laravel keeps a cetain convention for rules: so the function is called
	 * validateGreaterThen, then the rue is greater_then.
	 * 
	 * A validation rule accepts three parameters:
	 * - $attribute this is the name of the input.
	 * - $value this is the value of the input.
	 * - $parameters this is a paremeter for the rule, so greater_then:1,2 has two
	 * 	parameters.
	 * 
	 * The parameters are returnes as an array so for the first parameter:
	 * $parameters[0]
	 * 
	 * Now that we know how a rule works let's create one:
	 * 
	 * $attribute attribute_name1
	 * $value value1
	 * $parameters Table, attrubute_name2, value2
	 */
	public function validateUniqueWith($attribute, $value, $parameters) {
		/**
		 * Now that we have our data we can check for the data.
		 * 
		 * We first grab the correct table which is passed to the function. Now we
		 * need to do some checking using Eloquent. If you don't understand this,
		 * please let me know.
		 */
		$result = DB::table($parameters[0])->where(
			function($query) use ($attribute, $value, $parameters) {
				$query->where($attribute, '=', $value) // where firstname = value1
				->Where($parameters[1], '=', $parameters[2]); // where lastname = value2
			}
		)->first();
		/**
		 * No we check if we have a record. If we do have arecord we return false
		 * and the validation will fail. If we can´t find a record we return true
		 * and the validation will succeed.
		 */
		return $result ? false : true;
	}
	// If you need more examples, let me know ;)
}
