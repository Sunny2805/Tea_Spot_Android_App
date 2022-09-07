package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class forgotpassword extends AppCompatActivity {

    EditText ed1;
    Button btn1;
    ProgressDialog pd;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forgotpassword);

         ed1=findViewById(R.id.e1);
         btn1=findViewById(R.id.btn);

       btn1.setOnClickListener(new View.OnClickListener() {
           @Override
           public void onClick(View v) {

               new fg().execute();
           }
       });

    }


    class fg extends AsyncTask<Void, Void, View> {
        String l,  res;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            l = ed1.getText().toString();
            pd = new ProgressDialog(forgotpassword.this);
            pd.setMessage("Wait......");
            pd.show();
        }


        @Override

        protected View doInBackground(Void... voids) {

            WebServic obj = new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            list.add(new BasicNameValuePair("email", l));
            res = obj.PostData(GlobalURL.fg, list);
            return null;
        }

        @Override
        protected void onPostExecute(View aview) {
            super.onPostExecute(aview);
            pd.dismiss();

            try {
                JSONObject jobj=new JSONObject(res);
                String str=jobj.getString("msg");
                if(str.equals("Your password sent to your register emailid."))
                {
                    Toast.makeText(forgotpassword.this, "Your password sent to your register emailid.",Toast.LENGTH_LONG).show();
                }
                else {
                    Toast.makeText(forgotpassword.this, "Invalid Logind",Toast.LENGTH_LONG).show();
                }


            } catch (JSONException e) {
                e.printStackTrace();
            }


        }

    }



}
