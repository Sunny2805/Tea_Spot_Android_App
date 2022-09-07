package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.media.tv.TvContract;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
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

public class TransactionDetailsActivity extends AppCompatActivity {

    String month,year,cid;
    ProgressDialog pd;
    TextView tv1,tv2,tv3;
ListView lv;
ArrayList<String> aa_name,aa_date,aa_qty,aa_price,aa_time;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_transaction_details);

        lv=findViewById(R.id.lv);
         month=getIntent().getExtras().getString("month");
         year=getIntent().getExtras().getString("year");
        cid=getIntent().getExtras().getString("cid");

            tv1=findViewById(R.id.tv1);
        tv2=findViewById(R.id.tv2);
        tv3=findViewById(R.id.tv3);


        new LoadTransactionDetails().execute();

    }



    class LoadTransactionDetails extends AsyncTask<Void,Void,Void> {
        String res;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(TransactionDetailsActivity.this);
            pd.setMessage("Wait.....");
            pd.show();
            aa_name=new ArrayList<>();
            aa_date=new ArrayList<>();
            aa_price=new ArrayList<>();
            aa_time=new ArrayList<>();

            aa_qty=new ArrayList<>();

        }


        @Override

        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            list.add(new BasicNameValuePair("cid",cid));
            list.add(new BasicNameValuePair("m",month));
            list.add(new BasicNameValuePair("y",year));

            res = obj.PostData(GlobalURL.gettransaction, list);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();

            try {
                JSONObject jobj = new JSONObject(res);
                JSONArray jarr = jobj.getJSONArray("msg");
                int t = 0;
                for (int i = 0; i < jarr.length(); i++) {

                    JSONObject data = jarr.getJSONObject(i);
                    aa_name.add(data.getString("name"));
                    aa_qty.add(data.getString("qty"));
                    aa_date.add(data.getString("date"));
                    aa_price.add(data.getString("price"));
                    aa_time.add(data.getString("otime"));

                    t = t + (Integer.parseInt(aa_price.get(i)) * Integer.parseInt(aa_qty.get(i)));

                }


                if (jobj.getString("paid").equals("Paid")) {

                    tv2.setText("Status : Paid");
                    tv3.setText("Paid Date : "+jobj.getString("date"));
                }
                else
                {
                    tv2.setText("Status : Unpaid");
                    tv3.setVisibility(View.GONE);
                }

                tv1.setText("Total : "+t+" Rs.");
                lv.setAdapter(new mybase());

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

    }


    class mybase extends BaseAdapter
    {
        LayoutInflater inflater;

        mybase()
        {
            inflater=LayoutInflater.from(TransactionDetailsActivity.this);
        }

        @Override
        public int getCount() {
            return  aa_name.size() ;
        }

        @Override
        public Object getItem(int position) {
            return null;
        }

        @Override
        public long getItemId(int position) {
            return 0;
        }

        class ViewHolder
        {

            TextView tv1,tv2,tv3,tv4;

        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {

            ViewHolder h;
            if(convertView==null)
            {

                h=new ViewHolder();


                convertView=inflater.inflate(R.layout.transaction_row,null);
                h.tv1=convertView.findViewById(R.id.tv1);
                h.tv2=convertView.findViewById(R.id.tv2);
                h.tv3=convertView.findViewById(R.id.tv3);
                h.tv4=convertView.findViewById(R.id.tv4);

                convertView.setTag(h);
            }
            else
            {
                h=(ViewHolder) convertView.getTag();

            }
            h.tv1.setText("Name:"+aa_name.get(position));
            h.tv2.setText(aa_price.get(position)+"*"+aa_qty.get(position)+"="+String.valueOf(Integer.parseInt(aa_price.get(position))*Integer.parseInt(aa_qty.get(position))));
            h.tv3.setText(aa_date.get(position));
            h.tv4.setText(aa_time.get(position));

            return convertView;
        }
    }


}
