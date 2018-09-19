 <?php
 /**
 * This vendor file is for creating a paypal payout batch
 *
 * @var data 
 */
// PP Sandbox Account  : vim_payout_us@gmail.com
DEFINE("CLIENT_SECRET","AWqDW98qfqzsEW81pfcAEh_dZY0o6j8V9zMvgDkRDyiLC4vIFJ7c-5V-T9s7yQxtaqw-W1xk3CQ8WGac:EEvQ1GRey_hyqxo2mTrX-O0zVOqUtAwdC0uoflNhlTgV20LCmSPAve3im7iHCKxFMxJzRuRVtRRoR4PD");
DEFINE("ACCESS_TOKEN_URL","https://api.sandbox.paypal.com/v1/oauth2/token");
DEFINE("PAYOUT_URL","https://api.sandbox.paypal.com/v1/payments/payouts");

// For Production use below
//DEFINE("CLIENT_SECRET",<GET_FROM_LIVE_PAYPAL_ACCOUNT>);
// DEFINE("ACCESS_TOKEN_URL","https://api.paypal.com/v1/oauth2/token");
// DEFINE("PAYOUT_URL","https://api.paypal.com/v1/payments/payouts");


DEFINE ("PAYPAL_BATCH_DATA",$paypal_batch_data = '{
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
			}');