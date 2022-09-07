package com.example.myapplication;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.text.method.PasswordTransformationMethod;
import android.util.Patterns;
import android.view.MotionEvent;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
import android.widget.ProgressBar;
import android.widget.RadioButton;
import android.widget.Spinner;
import android.widget.TabWidget;
import android.widget.TextView;
import android.widget.Toast;

import com.basgeekball.awesomevalidation.AwesomeValidation;
import com.google.android.material.textfield.TextInputEditText;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.time.Month;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

import static com.basgeekball.awesomevalidation.ValidationStyle.BASIC;
public class registerpage extends AppCompatActivity {
    TextInputEditText t1, t2, t3, t4,t5;
    Button btn1;
    Spinner sp;
    ProgressDialog pd;
     ArrayList <String>aid,aname;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        final AwesomeValidation mailval=new AwesomeValidation(BASIC);
        t1 = findViewById(R.id.t1);
        t2 = findViewById(R.id.t2);
        t3 = findViewById(R.id.t3);
        t4 = findViewById(R.id.t4);
        t5 = findViewById(R.id.t5);
        sp=findViewById(R.id.sp);
        btn1 = findViewById(R.id.btn1);
        btn1.setOnClickListener(new View.OnClickListener() {
            @SuppressLint("ClickableViewAccessibility")
            @RequiresApi(api = Build.VERSION_CODES.O)
            @Override
            public void onClick(View view) {
                if (TextUtils.isEmpty(t1.getText().toString())) {
                    t1.setFocusableInTouchMode(true);
//                    t1.setFocusable(View.FOCUSABLE_AUTO);
                    t1.requestFocus();
                    t1.setError("Please Fill Full Name...!");
                } else if (TextUtils.isEmpty(t2.getText().toString())) {
                    t2.setFocusableInTouchMode(true);
//                    t2.setFocusable(View.FOCUSABLE_AUTO);
                    t2.requestFocus();
                    t2.setError("Please Fill Email Address...!");
                } else if ((!Patterns.EMAIL_ADDRESS.matcher(t4.getText().toString()).matches()) && (t4.getText().toString().length() >= 1)) {
                    t2.setFocusableInTouchMode(true);
                    t2.requestFocus();
                    t2.setError("Please The Valid Imail Address...!");
                } else if (TextUtils.isEmpty(t5.getText().toString())) {
                    t3.setFocusableInTouchMode(true);
                    t3.requestFocus();
                    t3.setError("Please  Enter Password...!");
                } else if (!(t5.length() >= 5)) {
                    t3.setFocusableInTouchMode(true);
                    t3.requestFocus();
                    t3.setError("Password Must Have % digit Atleast");
                } else if (TextUtils.isEmpty(t2.getText().toString())) {
                    t5.setFocusableInTouchMode(true);
                    t5.requestFocus();
                    t5.setError("Address Is Empty...!");
                }
                else
                {
                            AddUser obj=new AddUser();
                            obj.execute();
                }

            }
        });

        LoadArea obj=new LoadArea();
        obj.execute();

    }

    class AddUser extends  AsyncTask<Void,Void,Void>
    {

         String res,na,ad,arid,ph,e,ps;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
          pd=new ProgressDialog(registerpage.this);
          pd.setMessage("Wait..");
          pd.show();
          na=t1.getText().toString();
          ad=t2.getText().toString();
          arid= aid.get(aname.indexOf(sp.getSelectedItem().toString()));
          ph=t3.getText().toString();
          e=t4.getText().toString();
          ps=t5.getText().toString();
        }

        @Override
        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list=new ArrayList<>();
            list.add(new BasicNameValuePair("name",na));
            list.add(new BasicNameValuePair("address",ad));
            list.add(new BasicNameValuePair("areaid",arid));
            list.add(new BasicNameValuePair("phone",ph));
            list.add(new BasicNameValuePair("email",e));
            list.add(new BasicNameValuePair("password",ps));
            obj.PostData(GlobalURL.adduserurl,list);

             return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            Toast.makeText(registerpage.this,"Registration Successfully",Toast.LENGTH_LONG).show();
           finish();
        }


    }

     class LoadArea extends AsyncTask<Void,Void,Void>
     {

         String res;
         @Override
         protected void onPreExecute() {
             super.onPreExecute();
             pd=new ProgressDialog(registerpage.this);
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
                 ArrayAdapter<String> adp=new ArrayAdapter<>(registerpage.this,android.R.layout.simple_list_item_1,aname);
                 sp.setAdapter(adp);

             } catch (JSONException e) {
                 e.printStackTrace();
             }

         }
     }
}