package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.OperationApplicationException;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.jar.JarException;

public class viewcontract extends AppCompatActivity {
    ProgressDialog pd;
    ListView lv;
    String cid;

    SharedPreferences shp;

    ArrayList<String> aa_offname, aa_address, aa_areaid, aa_date,aa_cid,aa_status;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_viewcontract);
        lv = findViewById(R.id.lv);
        shp = getSharedPreferences("mypref", 0);
       // cid = getIntent().getExtras().getString("cid");
        contractdetails obj = new contractdetails();
        obj.execute();


    }


    class contractdetails extends AsyncTask<View, View, View> {
        // String uname, offname, address, areaid, date, cid,
        String res;

        @Override
        protected void onPreExecute() {

            super.onPreExecute();
            pd = new ProgressDialog(viewcontract.this);
            pd.setMessage("Wait.....");
            pd.show();
            aa_cid= new ArrayList<>();
            aa_offname = new ArrayList<>();
            aa_address = new ArrayList<>();
            aa_areaid = new ArrayList<>();
             aa_status=new ArrayList<>();
            aa_date = new ArrayList<>();
            cid = shp.getString("id", "0");

        }

        @Override
        protected View doInBackground(View... views) {

            WebServic obj = new WebServic();
            List<NameValuePair> list = new ArrayList<>();

            list.add(new BasicNameValuePair("uid",cid));

            res = obj.PostData(GlobalURL.addgetcontract,list);
            return null;

        }

        @Override
        protected void onPostExecute(View view) {
            super.onPostExecute(view);
            pd.dismiss();
            try {

                JSONObject json = new JSONObject(res);
                JSONArray obj = json.getJSONArray("msg");
                for (int i = 0; i < obj.length(); i++) {
                    {
                        JSONObject data = obj.getJSONObject(i);
                        //  aa_uname.add(data.getString("Contract_id"));
                        aa_cid.add(data.getString("Contract_id"));
                        aa_offname.add(data.getString("Office_Name"));
                        aa_address.add(data.getString("address"));
                        aa_areaid.add(data.getString("area"));
                        aa_date.add(data.getString("date"));
                        aa_status.add(data.getString("status"));


                    }
                    lv.setAdapter(new mybase());


                }


            } catch (JSONException e) {
                e.printStackTrace();
            }


        }
    }
        class mybase extends BaseAdapter {
            LayoutInflater inflater;

            mybase()
            {
                inflater=LayoutInflater.from(viewcontract.this);
            }



            @Override
            public int getCount() {
                return aa_cid.size();

            }


            @Override
            public Object getItem(int position) {
                return null;
            }

            @Override
            public long getItemId(int position) {return 0; }
            class ViewHolder
            {

                TextView tv1;
                TextView tv2;
                TextView tv3;
                TextView tv4,tv5;

                Button btn1,btn2;


            }

            @Override
            public View getView(final int position, View convertView, ViewGroup parent) {
                ViewHolder h;
                if(convertView==null)
                {

                    h=new ViewHolder();


                    convertView=inflater.inflate(R.layout.viewcontractdesig,null);

                    h.tv1=convertView.findViewById(R.id.t1);
                    h.tv2=convertView.findViewById(R.id.t2);
                    h.tv3=convertView.findViewById(R.id.t3);

                    h.tv4=convertView.findViewById(R.id.t4);
                    h.tv5=convertView.findViewById(R.id.t5);
                  h.btn1=convertView.findViewById(R.id.btn1);
                    h.btn2=convertView.findViewById(R.id.btn2);


                    // convertView.setTag(h);

                    convertView.setTag(h);
                }
                else
                {
                    h=(viewcontract.mybase.ViewHolder) convertView.getTag();

                }

              //  h.btn1.setId(Integer.parseInt(aa_cid.get(position)));
            //    h.btn2.setId(Integer.parseInt(aa_cid.get(position)));

                h.tv1.setText("Contract Id : "+aa_cid.get(position));
                h.tv2.setText("Office Name : "+aa_offname.get(position));
                h.tv3.setText("Address : \n"+aa_address.get(position)+","+aa_areaid.get(position));
                h.tv4.setText("Start Date:"+aa_date.get(position));

                h.tv5.setText("Status:"+aa_status.get(position));



                h.btn1.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        AlertDialog.Builder aa=new AlertDialog.Builder(viewcontract.this);
                        aa.setMessage("Do you want to deactive contract?");
                       aa.setTitle("Tea Spot");
                        aa.setNegativeButton("No", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {

                            }
                        });
                        aa.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                new ChangeStatus(aa_cid.get(position)).execute();
                               aa_status.set(position,"Deactive");

                               notifyDataSetChanged();
                            }
                        });
                        aa.show();
                        //Toast.makeText(viewcontract.this,"Hello",Toast.LENGTH_LONG).show();

                    }
                });

                h.btn2.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {


                        Intent i=new Intent(viewcontract.this,TransactionActivity.class);
                        i.putExtra("cid",aa_cid.get(position));
                        startActivity(i);
                        //Toast.makeText(viewcontract.this,"Hello",Toast.LENGTH_LONG).show();

                    }
                });

                if(aa_status.get(position).equals("Deactive"))
                {
                    h.btn1.setVisibility(View.GONE);
                }

                return convertView;

            }
        }

        class ChangeStatus extends  AsyncTask<Void,Void,Void>
        {
            String cid;
            String res;
            ChangeStatus(String cid)
            {
                this.cid=cid;
            }
            @Override
            protected void onPreExecute() {

                super.onPreExecute();
                pd = new ProgressDialog(viewcontract.this);
                pd.setMessage("Wait.....");
                pd.show();

            }

            @Override
            protected Void doInBackground(Void... voids) {
                WebServic obj = new WebServic();
                List<NameValuePair> list = new ArrayList<>();

                list.add(new BasicNameValuePair("cid",cid));

                res = obj.PostData(GlobalURL.contractstatus,list);

                return null;
            }

            @Override
            protected void onPostExecute(Void aVoid) {
                super.onPostExecute(aVoid);
               pd.dismiss();
                Toast.makeText(viewcontract.this,"Your Contract is Deactivated.",Toast.LENGTH_LONG).show();
            }
        }

    }
