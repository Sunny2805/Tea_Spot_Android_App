package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ListView;
import android.widget.Spinner;
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

public class vieworder extends AppCompatActivity {
    ListView lv;
    String cid;
    ArrayList<String> o_id, o_date, o_status, d_address, d_id, pyment, remark;
    SharedPreferences shp;
    ProgressDialog pd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_vieworder);

        lv = findViewById(R.id.lv);
        shp = getSharedPreferences("mypref", 0);

        Orderdetails obj = new Orderdetails();
        obj.execute();


    }

    class Orderdetails extends AsyncTask<View, View, View> {
        String res;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(vieworder.this);
            pd.setMessage("Wait....");
            pd.show();

            o_id = new ArrayList<>();
            o_date = new ArrayList<>();
            o_status = new ArrayList<>();
            d_address = new ArrayList<>();
            d_id = new ArrayList<>();
            pyment = new ArrayList<>();
            remark = new ArrayList<>();
           cid=shp.getString("id","");

        }

        @Override
        protected View doInBackground(View... views) {
            WebServic obj = new WebServic();
            List<NameValuePair> list = new ArrayList<>();
            list.add(new BasicNameValuePair("uid", cid));
            res = obj.PostData(GlobalURL.vieworder, list);

            return null;


        }




        @Override
        protected void onPostExecute(View view) {


            super.onPostExecute(view);
            pd.dismiss();



            try {
                JSONObject jobj = new JSONObject(res);

                JSONArray jarr = jobj.getJSONArray("msg");
                for (int i = 0; i < jarr.length(); i++) {

                    JSONObject data = jarr.getJSONObject(i);
                    o_id.add(data.getString("O_id"));
                    o_date.add(data.getString("O_date"));
                    o_status.add(data.getString("Order_Status"));
                    d_address.add(data.getString("D_address"));
                    d_id.add(data.getString("Deliveryboy"));
                    pyment.add(data.getString("P_mode"));
                    remark.add(data.getString("Remark"));


                }
                lv.setAdapter(new  mybase());

            } catch (JSONException e) {
                Toast.makeText(vieworder.this,e.toString(),Toast.LENGTH_LONG).show();

                e.printStackTrace();
            }


        }
    }
    class  mybase extends BaseAdapter{

        LayoutInflater inflater;

        mybase()
        {
            inflater=LayoutInflater.from(vieworder.this);
        }



        @Override
        public int getCount() {
            return o_id.size();
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

            TextView t1,t2,t3,t4,t5,t6,t7;

        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent)
        {
            ViewHolder h;
            if(convertView==null)
            {
                h=new ViewHolder();
                convertView=inflater.inflate(R.layout.vieeeeeee,null);
                h.t1=convertView.findViewById(R.id.t1);
                h.t2=convertView.findViewById(R.id.t2);
                h.t3=convertView.findViewById(R.id.t3);
                h.t4=convertView.findViewById(R.id.t4);
                h.t5=convertView.findViewById(R.id.t5);
                h.t6=convertView.findViewById(R.id.t6);
                h.t7=convertView.findViewById(R.id.t7);
                 convertView.setTag(h);
            }
            else{
                h=(ViewHolder)convertView.getTag();
            }

             h.t1.setText("Order Id : "+o_id.get(position));
            h.t2.setText("Order Date : "+o_date.get(position));
            h.t3.setText("Order Status : "+o_status.get(position));
            h.t4.setText("Payment Mode : "+pyment.get(position));
            h.t5.setText("Delivery Boy : "+d_id.get(position));
            h.t6.setText("Address : \n"+d_address.get(position));
            h.t7.setText("Remarks : \n"+remark.get(position));

            return convertView;
        }
    }
}