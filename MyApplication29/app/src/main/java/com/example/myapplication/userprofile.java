package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.JsonReader;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.Toast;

import com.google.android.material.textfield.TextInputEditText;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class userprofile extends AppCompatActivity {
    TextInputEditText t1,t2,t3;
    Button btn1;
    Spinner sp;
    ProgressDialog pd;
    ArrayList <String>aid,aname;
    SharedPreferences shp;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_userprofile);
        t1 = findViewById(R.id.t1);
        t2 = findViewById(R.id.t2);
        t3 = findViewById(R.id.t3);
         sp=findViewById(R.id.sp);
        btn1 = findViewById(R.id.btn1);
        shp=getSharedPreferences("mypref",0);
        btn1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
               UpdateProfile obj=new UpdateProfile();
               obj.execute();
            }
        });


       LoadArea obj=new LoadArea();
       obj.execute();

    }

    class UpdateProfile extends AsyncTask<Void,Void,Void>
    {
        String res,id,na,ad,arid,ph;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(userprofile.this);
            pd.setMessage("Wait.....");
            pd.show();
            id=shp.getString("id","0");
            na=t1.getText().toString();
            ad=t2.getText().toString();
            ph=t3.getText().toString();
            arid=aid.get(aname.indexOf(sp.getSelectedItem().toString()));

        }


        @Override
        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List <NameValuePair> list=new ArrayList<>();
            list.add(new BasicNameValuePair("name",na));
            list.add(new BasicNameValuePair("address",ad));
            list.add(new BasicNameValuePair("areaid",arid));
            list.add(new BasicNameValuePair("phone",ph));
            list.add(new BasicNameValuePair("id",id));
            res=obj.PostData(GlobalURL.updateprofileurl,list);
            return null;
        }


        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
          pd.dismiss();
            Toast.makeText(userprofile.this,"Your Profile Updated Successfully",Toast.LENGTH_LONG).show();
            finish();
        }


    }


    class loadprofile extends AsyncTask<Void,Void,Void>

    {
        String res,id,na,add,ph;
        @Override
        protected void onPreExecute() {

            super.onPreExecute();
            pd=new ProgressDialog(userprofile.this);
            pd.setMessage("Wait.....");
            pd.show();
            id=shp.getString("id","0");

        }

        @Override
        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            //String aid;
            List<NameValuePair> list=new ArrayList<>();
            list.add(new BasicNameValuePair("uid",id));
            res=obj.PostData(GlobalURL.profileurl,list);


        return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            try {
                JSONObject jobj=new JSONObject(res);
                na=jobj.getString("name");
                add=jobj.getString("address");
                ph=jobj.getString("phone_no");
                 t1.setText(na);
                 t2.setText(add);
                 t3.setText(ph);
                 //t1.setText(jobj.getString("name"));
                sp.setSelection(aid.indexOf(jobj.getString("area_id")));


            }
            catch (Exception e)
            {
                e.printStackTrace();
            }


        }
    }


    class LoadArea extends AsyncTask<Void,Void,Void>
    {

        String res;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(userprofile.this);
            pd.setMessage("Wait...");
            pd.show();
            aid=new ArrayList<>();
            aname=new ArrayList<>();

        }

        @Override
        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list=new ArrayList<>();
            res= obj.PostData(GlobalURL.areaurl,list);

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
                    aid.add(data.getString("aid"));
                    aname.add(data.getString("aname"));
                }
                ArrayAdapter<String> adp=new ArrayAdapter<>(userprofile.this,android.R.layout.simple_list_item_1,aname);
                sp.setAdapter(adp);

                loadprofile obj=new loadprofile();
                obj.execute();

            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }

}

