<?php 
$base_url = $this->webroot.'/paypal';
?>
<div style='width:600px;margin-left:20px;height:800px;'>
<form name='paypal_payout' method='POST' action="<?php echo $base_url;?>">
  <textarea name="paypal_payout_textarea"class="form-control" rows="40" cols="100">
  '{
			  "sender_batch_header": {
				"sender_batch_id": '.mt_rand(1000,99999).',
				"email_subject": "You have a payout!",
				"email_message": "You have received a payout! Thanks for using our service!"
			  },
			  "items": [
				{
				  "recipient_type": "EMAIL",
				  "amount": {
					"value": "9.87",
					"currency": "USD"
				  },
				  "note": "Thanks for your patronage!",
				  "sender_item_id": "20140314002011",
				  "receiver": "vimalbuyertest@gmail.com"
				},
				{
				  "recipient_type": "EMAIL",
				  "amount": {
					"value": "15.30",
					"currency": "USD"
				  },
				  "note": "Thanks for your patronage2!",
				  "sender_item_id": "2014031420002",
				  "receiver": "vsdsadd@gmail.com"
				},
				{
				  "recipient_type": "EMAIL",
				  "amount": {
					"value": "15.30",
					"currency": "USD"
				  },
				  "note": "Thanks for your patronage2!",
				  "sender_item_id": "2014031420002",
				  "receiver": "vimalunverified@gmail.com"
				}
				
			  ]
			}'
  </textarea>
 
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>