package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;


public class ProductDescription extends AppCompatActivity {

    TextView tv,tv1,tv2,tv3,tvtotal;
    Button btn1,btn2,btn3;
    ImageView iv;
    ProgressDialog pd;
    SharedPreferences shp;
    String pid;
    String price;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product_description);



        tv=findViewById(R.id.tv);
        tv1=findViewById(R.id.tv1);
        tv2=findViewById(R.id.tv2);
        tv3=findViewById(R.id.tv3);
        btn1=findViewById(R.id.increase);
        btn2=findViewById(R.id.decrease);
        btn3=findViewById(R.id.cart);
        iv=findViewById(R.id.iv);
        tvtotal=findViewById(R.id.tvtotal);

        shp=getSharedPreferences("mypref",0);

        Intent i=getIntent();
        Bundle b=i.getExtras();
        price=b.getString("price");
        pid=b.getString("id","");
        tv.setText(b.getString("name"));
        tv2.setText(b.getString("price")+"Rs.");
        tv1.setText(b.getString("desc"));
        String path=GlobalURL.imgurl+b.getString("photo").replace("\\","/");
        Glide.with(ProductDescription.this).load(path).into(iv);
        tv3.setText("1");

        tvtotal.setText("Total : "+String.valueOf(Integer.parseInt(price)*1)+"Rs.");

        btn1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int i=Integer.parseInt(tv3.getText().toString());
                i++;
                tv3.setText(String.valueOf(i));

                tvtotal.setText("Total : "+String.valueOf(Integer.parseInt(price)*i)+"Rs.");

            }
        });


        btn2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int i = Integer.parseInt(tv3.getText().toString());

                if(i<=1)
                {
                    Toast.makeText(ProductDescription.this, "Add Minimum Quantity 1", Toast.LENGTH_SHORT).show();
                    finish();
                }
                else {


                    i--;
                    tv3.setText(String.valueOf(i));

                    tvtotal.setText("Total : "+String.valueOf(Integer.parseInt(price)*i)+"Rs.");

                }

            }
        });


        btn3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Toast.makeText(ProductDescription.this,"Login if you want to buy item",Toast.LENGTH_LONG).show();

                startActivity(new Intent(ProductDescription.this,MainActivity.class));
                 finish();


            }
        });
    }
}
