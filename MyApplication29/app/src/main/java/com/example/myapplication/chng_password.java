package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.Settings;
import android.util.JsonReader;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.google.android.material.textfield.TextInputEditText;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class chng_password extends AppCompatActivity {

    TextInputEditText t1, t2,t3;
    Button btn;
    SharedPreferences shp;
    String id;
    ProgressDialog pd;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chng_password);
         t1=findViewById(R.id.t1);
        t2=findViewById(R.id.t2);
        t3=findViewById(R.id.t3);
        btn=findViewById(R.id.btn);
        shp=getSharedPreferences("mypref",0);
         id=shp.getString("id","");

        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
              CP obj=new CP();
              obj.execute();
            }
        });

    }
    class CP extends AsyncTask<Void,Void,Void>
    {
        String res,op,np;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(chng_password.this);
            pd.setMessage("Wait...");
            pd.show();
            op=t1.getText().toString();
            np=t2.getText().toString();

        }

        @Override
        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            list.add(new BasicNameValuePair("uid", id));
            list.add(new BasicNameValuePair("op", op));
            list.add(new BasicNameValuePair("np", np));
            res=obj.PostData(GlobalURL.cpurl,list);

            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            try {
                JSONObject jobj=new JSONObject(res);
                String msg=jobj.getString("msg");
                Toast.makeText(chng_password.this,msg+" "+op+" "+np+" "+id,Toast.LENGTH_LONG).show();
            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }
}
