package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

import org.apache.http.NameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class ViewCategory extends AppCompatActivity {

    ProgressDialog pd;
    SharedPreferences shp;
    GridView gv;
    ArrayList<String> aa_cid,aa_name,aa_photo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_category);

         gv=findViewById(R.id.gv);
     new getcategory().execute();

        gv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i=new Intent(ViewCategory.this,ProductList.class);
                i.putExtra("cid",aa_cid.get(position));
                startActivity(i);
            }
        });

    }


    class getcategory extends AsyncTask<Void,Void,Void> {
        String res;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(ViewCategory.this);
            pd.setMessage("Wait.....");
            pd.show();
            aa_cid=new ArrayList<>();
            aa_name=new ArrayList<>();
            aa_photo=new ArrayList<>();

        }


        @Override

        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            res = obj.PostData(GlobalURL.getcategory, list);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            try {
                JSONObject jobj=new JSONObject(res);
                JSONArray jarr=jobj.getJSONArray("msg");
                for(int i=0;i<jarr.length();i++)
                {

                    JSONObject data=jarr.getJSONObject(i);
                    aa_cid.add(data.getString("cid"));
                    aa_name.add(data.getString("cname"));
                    aa_photo.add(data.getString("photo"));

                }

                gv.setAdapter(new mybase());

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
            inflater=LayoutInflater.from(ViewCategory.this);
        }

        @Override
        public int getCount() {
            return aa_cid.size() ;
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


            ImageView iv;
            TextView tv,pr;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            ViewHolder h;
            if(convertView==null)
            {
                h=new ViewHolder();
                convertView=inflater.inflate(R.layout.categoryrow,null);
                h.iv=convertView.findViewById(R.id.iv);
                h.tv=convertView.findViewById(R.id.tv);
                convertView.setTag(h);
            }
            else
            {
                h=(ViewHolder) convertView.getTag();

            }
            h.tv.setText(aa_name.get(position));

            String path=GlobalURL.imgurl+aa_photo.get(position).replace("\\","/");
            Glide.with(ViewCategory.this).load(path).into(h.iv);

            return convertView;
        }
    }


}
