package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RatingBar;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;

import java.util.ArrayList;
import java.util.List;

public class feedback extends AppCompatActivity {
    EditText fd;
    RatingBar rat;
    Button btn1;
    SharedPreferences shp;
    ProgressDialog pd;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_feedback);
        fd=findViewById(R.id.t1);
        rat=findViewById(R.id.rat1);
        btn1=findViewById(R.id.btn1);
        shp=getSharedPreferences("mypref",0);
        btn1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                feedback1 obj=new feedback1();
                obj.execute();

            }




        });



    }
    class feedback1 extends AsyncTask<Void,Void,Void>{
        String feed,r,uid;


        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(feedback.this);
            pd.setMessage("wait.....");
            pd.show();
            feed=fd.getText().toString();
            r= String.valueOf(rat.getRating());
            uid=shp.getString("id","");

        }
        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair>list=new ArrayList<>();
           // list.add(new BasicNameValuePair("User_id":));
            list.add(new BasicNameValuePair("Feedback",feed));
            list.add(new BasicNameValuePair("Rate",r));
            list.add(new BasicNameValuePair("User_id",uid));


            obj.PostData(GlobalURL.logfeedback,list);


            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            Toast.makeText(feedback.this,"FeedBack Successfully",Toast.LENGTH_LONG).show();
            finish();

        }
    }


}
