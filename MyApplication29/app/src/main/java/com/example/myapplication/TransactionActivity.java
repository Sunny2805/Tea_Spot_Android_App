package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
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

public class TransactionActivity extends AppCompatActivity {


    ProgressDialog pd;
    String cid;
    ListView lv;
    ArrayList<String> aa_month,aa_year;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_transaction);

         lv=findViewById(R.id.lv);
cid=getIntent().getExtras().getString("cid");

        Toast.makeText(TransactionActivity.this,cid,Toast.LENGTH_LONG).show();

 new LoadTransaction().execute();

  lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
      @Override
      public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

          Intent i=new Intent(TransactionActivity.this,TransactionDetailsActivity.class);
          i.putExtra("month",aa_month.get(position));
          i.putExtra("year",aa_year.get(position));
          i.putExtra("cid",cid);
          startActivity(i);


      }
  });

    }



    class LoadTransaction extends AsyncTask<Void,Void,Void> {
        String res;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(TransactionActivity.this);
            pd.setMessage("Wait.....");
            pd.show();
            aa_month=new ArrayList<>();
            aa_year=new ArrayList<>();
            }


        @Override

        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            list.add(new BasicNameValuePair("cid",cid));
            res = obj.PostData(GlobalURL.monthstatus, list);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            Toast.makeText(TransactionActivity.this,res,Toast.LENGTH_LONG).show();

            try {
                JSONObject jobj=new JSONObject(res);
                JSONArray jarr=jobj.getJSONArray("msg");
                for(int i=0;i<jarr.length();i++)
                {

                    JSONObject data=jarr.getJSONObject(i);
                    aa_year.add(data.getString("year"));
                    aa_month.add(data.getString("month"));

                }

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
            inflater=LayoutInflater.from(TransactionActivity.this);
        }

        @Override
        public int getCount() {
            return  aa_month.size() ;
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

            TextView tv;

        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {

            ViewHolder h;
            if(convertView==null)
            {

                h=new ViewHolder();


                convertView=inflater.inflate(R.layout.month_row,null);
                h.tv=convertView.findViewById(R.id.tv);
                convertView.setTag(h);
            }
            else
            {
                h=(ViewHolder) convertView.getTag();

            }
            h.tv.setText(aa_year.get(position)+"-"+aa_month.get(position));

            return convertView;
        }
    }
}
