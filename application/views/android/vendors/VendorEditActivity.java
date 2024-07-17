
public class VendorEditActivity extends AppCompatActivity {
	
	private text Vendor_Type;
				private text TaxPayer_NTN;
				private text TaxPayer_CNIC;
				private text TaxPayer_Name;
				private text TaxPayer_City;
				private text TaxPayer_Address;
				private text TaxPayer_Status;
				private text TaxPayer_Business_Name;
				private text Focal_Person;
				private text Contact_No;
				private Button btn_update_vendors;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_edit_vendor);
		
		Vendor_Type = (text)findViewById(R.id.Vendor_Type);
				TaxPayer_NTN = (text)findViewById(R.id.TaxPayer_NTN);
				TaxPayer_CNIC = (text)findViewById(R.id.TaxPayer_CNIC);
				TaxPayer_Name = (text)findViewById(R.id.TaxPayer_Name);
				TaxPayer_City = (text)findViewById(R.id.TaxPayer_City);
				TaxPayer_Address = (text)findViewById(R.id.TaxPayer_Address);
				TaxPayer_Status = (text)findViewById(R.id.TaxPayer_Status);
				TaxPayer_Business_Name = (text)findViewById(R.id.TaxPayer_Business_Name);
				Focal_Person = (text)findViewById(R.id.Focal_Person);
				Contact_No = (text)findViewById(R.id.Contact_No);
				btn_edit_vendors = (Button)findViewById(R.id.btn_update_vendors);
		
		
		
		Intent intent = getIntent();
		String id = intent.getStringExtra("id");
		
		RequestQueue request_queue = Volley.newRequestQueue(VendorEditActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/vendor/view_vendor/"+id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									Vendor_Type.setText(json_object.getString("Vendor_Type"));
				TaxPayer_NTN.setText(json_object.getString("TaxPayer_NTN"));
				TaxPayer_CNIC.setText(json_object.getString("TaxPayer_CNIC"));
				TaxPayer_Name.setText(json_object.getString("TaxPayer_Name"));
				TaxPayer_City.setText(json_object.getString("TaxPayer_City"));
				TaxPayer_Address.setText(json_object.getString("TaxPayer_Address"));
				TaxPayer_Status.setText(json_object.getString("TaxPayer_Status"));
				TaxPayer_Business_Name.setText(json_object.getString("TaxPayer_Business_Name"));
				Focal_Person.setText(json_object.getString("Focal_Person"));
				Contact_No.setText(json_object.getString("Contact_No"));
				
			
								}
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							 //   Toast.makeText(MainActivity.this, "error", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(VendorAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);



	
btn_update_vendors.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
              final String form_Vendor_Type = Vendor_Type.getText().toString();
				final String form_TaxPayer_NTN = TaxPayer_NTN.getText().toString();
				final String form_TaxPayer_CNIC = TaxPayer_CNIC.getText().toString();
				final String form_TaxPayer_Name = TaxPayer_Name.getText().toString();
				final String form_TaxPayer_City = TaxPayer_City.getText().toString();
				final String form_TaxPayer_Address = TaxPayer_Address.getText().toString();
				final String form_TaxPayer_Status = TaxPayer_Status.getText().toString();
				final String form_TaxPayer_Business_Name = TaxPayer_Business_Name.getText().toString();
				final String form_Focal_Person = Focal_Person.getText().toString();
				final String form_Contact_No = Contact_No.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(VendorAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, url+"/mobile/vendor/save_data/"+form_vendor_id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(VendorAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(VendorAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("Vendor_Type", form_Vendor_Type);
				params.put("TaxPayer_NTN", form_TaxPayer_NTN);
				params.put("TaxPayer_CNIC", form_TaxPayer_CNIC);
				params.put("TaxPayer_Name", form_TaxPayer_Name);
				params.put("TaxPayer_City", form_TaxPayer_City);
				params.put("TaxPayer_Address", form_TaxPayer_Address);
				params.put("TaxPayer_Status", form_TaxPayer_Status);
				params.put("TaxPayer_Business_Name", form_TaxPayer_Business_Name);
				params.put("Focal_Person", form_Focal_Person);
				params.put("Contact_No", form_Contact_No);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		
        
    }

}
