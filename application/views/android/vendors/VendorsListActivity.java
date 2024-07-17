
public class VendorsListActivity extends AppCompatActivity {
	
	static String[][] Items;
    private GoogleApiClient client;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_list_vendors);
		
		RequestQueue request_queue = Volley.newRequestQueue(VendorsListActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/vendors/view", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								 Items = new String[JsonArray.length()][10];
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									Items[i][0] = json_object.getString("Vendor_Type");
				Items[i][1] = json_object.getString("TaxPayer_NTN");
				Items[i][2] = json_object.getString("TaxPayer_CNIC");
				Items[i][3] = json_object.getString("TaxPayer_Name");
				Items[i][4] = json_object.getString("TaxPayer_City");
				Items[i][5] = json_object.getString("TaxPayer_Address");
				Items[i][6] = json_object.getString("TaxPayer_Status");
				Items[i][7] = json_object.getString("TaxPayer_Business_Name");
				Items[i][8] = json_object.getString("Focal_Person");
				Items[i][9] = json_object.getString("Contact_No");
				
			
								}
								
								VendorsAdapter vendorsAdapter;
                    			vendorsAdapter = new VendorsAdapter(VendorsListActivity.this,Items);
                    			vendors_listView.setAdapter(vendorsAdapter);
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							    Toast.makeText(VendorsListActivity, "Error in Json", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(VendorsListActivity, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);
		
		
		
 vendors_listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i = new Intent(VendorsListActivity.this, VendorsView.class);
                i.putExtra("vendor_id", Items[position][0]);
                startActivity(i);
            }
        });
		
		

        
    }

}
