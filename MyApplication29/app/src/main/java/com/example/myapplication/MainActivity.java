package com.example.myapplication;

import androidx.annotation.MainThread;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import android.animation.TimeAnimator;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
import android.text.TextUtils;
import android.text.method.PasswordTransformationMethod;
import android.util.Patterns;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.basgeekball.awesomevalidation.AwesomeValidation;
import com.google.android.material.textfield.TextInputEditText;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import static com.basgeekball.awesomevalidation.ValidationStyle.BASIC;
import static com.example.myapplication.R.string;

public class MainActivity extends AppCompatActivity {
    TextView empty_mail;

    TextInputEditText t1, t2;
    TextView  t3,fp;
    Button btn1;
    ProgressDialog pd;
    CheckBox ch;
    public Object MainActivity;
    SharedPreferences shp;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        final AwesomeValidation mailval = new AwesomeValidation(BASIC);
        AwesomeValidation passval = new AwesomeValidation(BASIC);
        t1 = findViewById(R.id.t1);
        t2 = findViewById(R.id.t2);
        t3 = findViewById(R.id.t3);
       fp=findViewById(R.id.fp);

        btn1 = findViewById(R.id.btn1);
        t2.setTransformationMethod(new PasswordTransformationMethod());
        shp=getSharedPreferences("mypref",0);
        // mailval.addValidation(this, R.id.t1, Patterns.EMAIL_ADDRESS.mail);
        try {
            btn1.setOnClickListener (new View.OnClickListener() {
                @RequiresApi(api = Build.VERSION_CODES.O)
                @Override
                public void onClick(View view) {
                    if (!Patterns.EMAIL_ADDRESS.matcher(t1.getText().toString()).matches()) {
                        t1.setFocusableInTouchMode(true);
                          t1.setFocusable(true);
                        t1.requestFocus();
                        t1.setError("EMAIL ADDRESS PROPER");
                        //Toast.makeText(MainActivity.this, "Invalid....", Toast.LENGTH_SHORT).show();
                    } else if (TextUtils.isEmpty(t2.getText().toString())) {
                        t2.setFocusableInTouchMode(true);
                         t2.setFocusable(true);
                        t2.requestFocus();
                        t2.setError("Password Is Empty.....!");
                    } else if (t2.length() > 0 && t2.length() < 5) {
                        t2.setFocusableInTouchMode(true);
                        //  t2.setFocusable(View.FOCUSABLE);
                        t2.requestFocus();
                        t2.setError("Password Must Have 5 Digit...!");
                    } else if ((mailval.validate()) && (t2.length() >= 5)) {
                             cheklogin obj=new cheklogin();
                             obj.execute();
                    }


                }
            });
            t3.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent;
                    intent = new Intent(com.example.myapplication.MainActivity.this, registerpage.class);
                    startActivity(intent);
                }
            });

            fp.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Intent i=new Intent(MainActivity.this,forgotpassword.class);
                    startActivity(i);
                }
            });
        } catch (Exception e1) {
            Toast.makeText(this, e1.getMessage(), Toast.LENGTH_SHORT).show();
        }


    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.mymenu,menu);

        return super.onCreateOptionsMenu(menu);
        }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

         if(item.getItemId()==R.id.t1)
         {
             startActivity(new Intent(MainActivity.this,ViewCategory.class));
             finish();

         }
        return super.onOptionsItemSelected(item);
    }

    class cheklogin extends AsyncTask<Void, Void, View> {
        String l, p, res;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            l = t1.getText().toString();
            p = t2.getText().toString();
            pd = new ProgressDialog(MainActivity.this);
            pd.setMessage("Wait......");
            pd.show();
        }


        @Override

        protected View doInBackground(Void... voids) {

             WebServic obj = new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            list.add(new BasicNameValuePair("l", l));
            list.add(new BasicNameValuePair("p", p));
            res = obj.PostData(GlobalURL.loginurl, list);
            return null;
        }

        @Override
        protected void onPostExecute(View aview) {
            super.onPostExecute(aview);
            pd.dismiss();

            try {
                JSONObject jobj=new JSONObject(res);
                String str=jobj.getString("msg");
                if(str.equals("valid"))
                {
                    String uid=jobj.getString("uid");
                    String name=jobj.getString("name");
                    SharedPreferences.Editor ed=shp.edit();
                    ed.putString("id",uid);
                    ed.putString("na",name);
                    ed.commit();
                    Intent i=new Intent(MainActivity.this,Welcome.class);
                    startActivity(i);
                    finish();

                }
                else {
                    Toast.makeText(MainActivity.this, "Invalid Logind & Password",Toast.LENGTH_LONG).show();
                }


            } catch (JSONException e) {
                e.printStackTrace();
            }


        }

    }

}
