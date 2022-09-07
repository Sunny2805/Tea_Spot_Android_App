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
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class buyitm extends AppCompatActivity {
    ListView lv;
    String cid,oid;
    ArrayList<String> item_id,item_name,item_qty,item_photo,item_price;
    ImageView iv;
    SharedPreferences shp;
    ProgressDialog pd;
    TextView tvtotal;
    int sum=0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_buyitm);
        lv=findViewById(R.id.lv);
       tvtotal=findViewById(R.id.tvtotal);
        shp = getSharedPreferences("mypref", 0);
        //cid=getIntent().getExtras().getString("cid");
        oid=getIntent().getExtras().getString("oid");
        byorder obj=new byorder();
        obj.execute();



    }


    class byorder extends AsyncTask<View,View,View>{
        String res;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(buyitm.this);
            pd.setMessage("Wait.....");
            pd.show();
            item_id=new ArrayList<>();
            item_name=new ArrayList<>();
            item_qty=new ArrayList<>();
            item_price=new ArrayList<>();
            item_photo=new ArrayList<>();



        }


        @Override
        protected View doInBackground(View... views) {
            WebServic obj=new WebServic();
            List<NameValuePair> list=new ArrayList<>();
            list.add(new BasicNameValuePair("od_id",oid));
            res=obj.PostData(GlobalURL.getorderdetails,list);
            return null;
        }

        @Override
        protected void onPostExecute(View view) {
            super.onPostExecute(view);

            pd.dismiss();
            try {
                JSONObject  jobj=new JSONObject(res);
                JSONArray  jarr=jobj.getJSONArray("msg");
                for(int i=0;i<jarr.length();i++)
                {

                    JSONObject data=jarr.getJSONObject(i);

                    item_name.add(data.getString("item_name"));
                    item_price.add(data.getString("i_price"));

                    item_qty.add(data.getString("qty"));
                    item_photo.add(data.getString("item_photo"));

                  sum=sum+Integer.parseInt(item_qty.get(i))*Integer.parseInt(item_price.get(i));

                }

                tvtotal.setText("Total : "+String.valueOf(sum)+"Rs.");
                lv.setAdapter(new mybase());

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        }
    class mybase extends BaseAdapter {
        LayoutInflater inflater;

        mybase() {
            inflater = LayoutInflater.from(buyitm.this);
        }

        @Override
        public int getCount() {
            return item_name.size();
        }

        @Override
        public Object getItem(int position) {
            return null;
        }

        @Override
        public long getItemId(int position) {
            return 0;
        }


        class ViewHolder {

            ImageView iv;
            TextView na;
            TextView pr,tvt;
            TextView qty;

        }


        @Override
        public View getView(int position, View convertView, ViewGroup parent) {

            ViewHolder h;
            if (convertView == null) {

                 h = new ViewHolder();


                convertView = inflater.inflate(R.layout.buyitemdesigen, null);
                h.iv = convertView.findViewById(R.id.img);
                h.na = convertView.findViewById(R.id.name);
                h.pr = convertView.findViewById(R.id.price);
                h.qty = convertView.findViewById(R.id.qty);

                h.tvt = convertView.findViewById(R.id.tvt);
                convertView.setTag(h);
            } else {
                h=(ViewHolder)convertView.getTag();

            }

            h.na.setText(item_name.get(position));
            h.pr.setText(item_price.get(position) + " Rs");
            h.qty.setText("Quantity : "+item_qty.get(position));
            h.tvt.setText("Total : "+String.valueOf(Integer.parseInt(item_qty.get(position))*Integer.parseInt(item_price.get(position))));
            String path = GlobalURL.imgurl + item_photo.get(position).replace("\\", "/");
            Glide.with(buyitm.this).load(path).into(h.iv);

          return convertView;
        }
    }
}
