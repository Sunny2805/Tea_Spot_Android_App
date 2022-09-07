package com.example.myapplication;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Patterns;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.textfield.TextInputEditText;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

public class contract extends AppCompatActivity {
    TextInputEditText t1, t2,t3;
    TextView tvv;
    DatePicker datePicker1;
    Button btn;
    Spinner sp;
    SharedPreferences shp;
    String id,dt;
    ProgressDialog pd;
    ArrayList<String> aid,aname;
    @RequiresApi(api = Build.VERSION_CODES.O)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_contract);
        t1 = findViewById(R.id.t1);
        t2 = findViewById(R.id.t2);
        t3 = findViewById(R.id.t3);
        datePicker1=findViewById(R.id.datePicker1);
            sp = findViewById(R.id.sp);
        shp = getSharedPreferences("mypref", 0);
        btn = findViewById(R.id.btn1);
        btn.setOnClickListener(new View.OnClickListener() {
            @SuppressLint("ClickableViewAccessibility")
            @RequiresApi(api = Build.VERSION_CODES.O)
            @Override
            public void onClick(View view) {

                takecontract obj = new takecontract();
                obj.execute();


            }
        });


        Calendar c = Calendar.getInstance();
        int mYear = c.get(Calendar.YEAR);
        int mMonth = c.get(Calendar.MONTH);
        int mDay = c.get(Calendar.DAY_OF_MONTH);



       datePicker1.setVisibility(View.GONE);
        t3.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                 if(hasFocus) {
                     datePicker1.setVisibility(View.VISIBLE);
                 }
                 else
                 {
                     datePicker1.setVisibility(View.GONE);

                 }

                 }
        });

        datePicker1.init(mYear, mMonth,mDay, new DatePicker.OnDateChangedListener() {
                    @SuppressLint("SetTextI18n")
                    @Override
                    public void onDateChanged(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                         dt=year+"-"+(monthOfYear+1)+"-"+dayOfMonth;
                        t3.setText(dayOfMonth+"-"+(monthOfYear+1)+"-"+year);
                         }

                }
        );

     /* datePicker1.setOnDateChangedListener(new DatePicker.OnDateChangedListener() {
           @Override
           public void onDateChanged(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
               t3.setText(dayOfMonth+"-"+monthOfYear+"-"+year);
           }
       });*/
        LoadArea obj = new LoadArea();
        obj.execute();
    }
    class takecontract extends  AsyncTask<Void,Void,Void>
    {

        String res,of,adr,arid,id;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(contract.this);
            pd.setMessage("Wait..");
            pd.show();
            of=t1.getText().toString();
            adr=t2.getText().toString();

            arid= aid.get(aname.indexOf(sp.getSelectedItem().toString()));
            id=shp.getString("id","0");

        }

        @Override
        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list=new ArrayList<>();
            list.add(new BasicNameValuePair("Office_Name",of));
            list.add(new BasicNameValuePair("Address",adr));
            list.add(new BasicNameValuePair("Area_id",arid));
            list.add(new BasicNameValuePair("dt",dt));
            list.add(new BasicNameValuePair("uid",id));
            obj.PostData(GlobalURL.addcontract,list);

            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            Toast.makeText(contract.this,"Take contract Successfully",Toast.LENGTH_LONG).show();
            finish();
        }


    }




    class LoadArea extends AsyncTask<Void,Void,Void>
    {

        String res;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(contract.this);
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
                ArrayAdapter<String> adp=new ArrayAdapter<>(contract.this,android.R.layout.simple_list_item_1,aname);
                sp.setAdapter(adp);

            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }

}
