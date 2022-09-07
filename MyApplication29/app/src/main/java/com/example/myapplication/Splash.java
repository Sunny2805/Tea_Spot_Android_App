package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;

public class Splash extends AppCompatActivity {

    SharedPreferences shp;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
       shp=getSharedPreferences("mypref",0);

        Handler  handler=new Handler();

        handler.postDelayed(new Runnable() {
            @Override
            public void run() {

                if(shp.getString("id","").equals("")) {
                    Intent i = new Intent(Splash.this, MainActivity.class);
                    startActivity(i);
                    finish();
                }
                else
                {
                    Intent i = new Intent(Splash.this, Welcome.class);
                    startActivity(i);
                    finish();

                }
            }
        },2500);

    }
}
