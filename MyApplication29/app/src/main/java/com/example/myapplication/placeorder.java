package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
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

public class placeorder extends AppCompatActivity {
    TextInputEditText t1, t2;
    Button btn1;
    Spinner sp;
    ProgressDialog pd;
    ArrayList<String> aid, aname;
    SharedPreferences shp;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_placeorder);
        shp=getSharedPreferences("mypref",0);
        t1 = findViewById(R.id.t1);
        t2 = findViewById(R.id.t2);
        sp = findViewById(R.id.sp);
        btn1 = findViewById(R.id.btn1);
        btn1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


                 int flag=0;
                 String str="";
                if(t2.getText().toString().equals(""))
                {
                    str=str+"Enter Delivery Address\n";
                    flag=1;
                    t2.setError("Enter Delivery Address");
                }

                if(sp.getSelectedItem().toString().equals("--Select Area--"))
                {
                    flag=1;
                    str=str+"Select Area\n";


                }

                if(flag==0) {
                    place obj = new place();
                    obj.execute();
                }
                else
                {
                  Toast.makeText(placeorder.this,str,Toast.LENGTH_LONG).show();
                }
            }
        });

        LoadArea obj = new LoadArea();
        obj.execute();


    }
    class place extends AsyncTask<View,View,View>
    {
        String res,arid,rem,adr;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(placeorder.this);
            pd.setMessage("Wait...");
            pd.show();
            rem=t1.getText().toString();
            adr=t2.getText().toString()+","+sp.getSelectedItem().toString();

        }

        @Override

        protected View doInBackground(View... views) {

            WebServic obj=new WebServic();
            List<NameValuePair> list=new ArrayList<>();
             list.add(new BasicNameValuePair("uid",shp.getString("id","")));
            list.add(new BasicNameValuePair("remark",rem));
            list.add(new BasicNameValuePair("address",adr));

            obj.PostData(GlobalURL.addorder,list);
            return null;
        }


        @Override
        protected void onPostExecute(View view) {
            super.onPostExecute(view);

             pd.dismiss();
            Toast.makeText(placeorder.this,"Your order place successfully",Toast.LENGTH_LONG).show();

            Intent i = new Intent(placeorder.this,vieworder1.class);
            startActivity(i);
            finish();

           /* Intent i=new Intent(placeorder.this,OrderHistory.class);
            startActivity(i);
            finish();*/
        }
    }




    class LoadArea extends AsyncTask<Void,Void,Void>
    {

        String res;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(placeorder.this);
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
                ArrayAdapter<String> adp=new ArrayAdapter<>(placeorder.this,android.R.layout.simple_list_item_1,aname);
                sp.setAdapter(adp);

            } catch (JSONException e) {
                e.printStackTrace();
            }


        }
    }
}
