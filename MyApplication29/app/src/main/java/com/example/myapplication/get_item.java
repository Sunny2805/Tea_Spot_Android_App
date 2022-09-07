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
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class get_item extends AppCompatActivity {
    ProgressDialog pd;
    SharedPreferences shp;
    GridView gv;
    String cid;
    ArrayList<String> item_id,item_name,item_price,item_description,item_photo;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_get_item);
        gv=findViewById(R.id.gv);
        shp=getSharedPreferences("mypref",0);
        cid=getIntent().getExtras().getString("cid");
        new getitem().execute();

        gv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                Intent i=new Intent(get_item.this,itemdesc.class);
                 i.putExtra("id",item_id.get(position));
                i.putExtra("name",item_name.get(position));
                i.putExtra("price",item_price.get(position));
                i.putExtra("desc",item_description.get(position));
                i.putExtra("photo",item_photo.get(position));

                startActivity(i);
            }
        });


    }
    class getitem extends AsyncTask<Void,Void,Void> {
        String res;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(get_item.this);
            pd.setMessage("Wait.....");
            pd.show();
            item_id=new ArrayList<>();
            item_name=new ArrayList<>();
            item_price=new ArrayList<>();
            item_description=new ArrayList<>();
            item_photo=new ArrayList<>();
        }


        @Override

        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            list.add(new BasicNameValuePair("cid",cid));
            res = obj.PostData(GlobalURL.getitem, list);
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
                    item_id.add(data.getString("i_id"));
                    item_name.add(data.getString("i_name"));
                    item_price.add(data.getString("i_price"));
                    item_description.add(data.getString("i_desc"));
                    item_photo.add(data.getString("i_photo"));

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
            inflater=LayoutInflater.from(get_item.this);
        }

        @Override
        public int getCount() {
            return item_id.size() ;
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
            TextView tv;
            TextView pr;

        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {

           ViewHolder h;
            if(convertView==null)
            {

                 h=new ViewHolder();


                convertView=inflater.inflate(R.layout.itemshow,null);
                h.iv=convertView.findViewById(R.id.iv);
                h.tv=convertView.findViewById(R.id.tv);
                h.pr=convertView.findViewById(R.id.pr);
                convertView.setTag(h);
            }
            else
            {
                h=(get_item.mybase.ViewHolder) convertView.getTag();

            }
            h.tv.setText(item_name.get(position));
            h.pr.setText(item_price.get(position)+" Rs");
            String path=GlobalURL.imgurl+item_photo.get(position).replace("\\","/");
            Glide.with(get_item.this).load(path).into(h.iv);

            return convertView;
        }
    }
}
