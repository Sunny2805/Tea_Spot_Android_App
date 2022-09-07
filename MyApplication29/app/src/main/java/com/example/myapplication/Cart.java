package com.example.myapplication;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class Cart extends AppCompatActivity {

   ListView lv;
    Button b1,btn2;
    SharedPreferences shp;
    ProgressDialog pd;
    ArrayList<String> cart_id, item_name, price, item_photo, qty;

    TextView tvtotal;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);
        shp=getSharedPreferences("mypref",0);
        lv = findViewById(R.id.lv);
        btn2=findViewById(R.id.btn2);
       tvtotal=findViewById(R.id.tvtotal);

        cart obj = new cart();
        obj.execute();
        btn2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent i=new Intent(Cart.this,placeorder.class);
                startActivity(i);
                finish();
            }
        });






    }


    class cart extends AsyncTask<Void, Void, Void> {
        String res;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(Cart.this);
            pd.setMessage("Wait.....");
            pd.show();
            cart_id = new ArrayList<>();
            item_name = new ArrayList<>();
            price = new ArrayList<>();
            item_photo = new ArrayList<>();
            qty = new ArrayList<>();
        }


        @Override

        protected Void doInBackground(Void... voids) {
            WebServic obj = new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            list.add(new BasicNameValuePair("uid",shp.getString("id","")));

            res = obj.PostData(GlobalURL.getcart, list);
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            pd.dismiss();
            int t=0;
            try {
                JSONObject jobj = new JSONObject(res);
                JSONArray jarr = jobj.getJSONArray("msg");
                for (int i = 0; i < jarr.length(); i++) {

                    JSONObject data = jarr.getJSONObject(i);
                    cart_id.add(data.getString("cartid"));
                    item_name.add(data.getString("item_name"));
                    price.add(data.getString("Price"));
                    item_photo.add(data.getString("photo"));
                    qty.add(data.getString("qty"));
                    t=t+(Integer.parseInt(qty.get(i))*Integer.parseInt(price.get(i)));
                }
                tvtotal.setText("Total : "+String.valueOf(t)+"Rs.");

              lv.setAdapter(new mybase());
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

    }


    class mybase extends BaseAdapter
    {
        LayoutInflater inflater;

        mybase()
        {
            inflater=LayoutInflater.from(Cart.this);
        }

        @Override
        public int getCount() {
            return item_name.size() ;
        }

        @Override
        public Object getItem(int position) {
            return null;
        }

        @Override
        public long getItemId(int position) {
            return 0;
        }

        class ViewHolder
        {

            ImageView iv;
            TextView tv,tvt;
            TextView pr,qty;
            Button btndelete;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {

            ViewHolder h;
            if(convertView==null)
            {

                h=new ViewHolder();


                convertView=inflater.inflate(R.layout.addcartitem,null);
                h.iv=convertView.findViewById(R.id.img);
                h.tv=convertView.findViewById(R.id.tit1);
                h.pr=convertView.findViewById(R.id.desc1);
                h.qty=convertView.findViewById(R.id.qty);

                h.tvt=convertView.findViewById(R.id.tvt);
                h.btndelete=convertView.findViewById(R.id.btndelete);


                convertView.setTag(h);
            }
            else
            {
                h=(ViewHolder) convertView.getTag();

            }
            h.tv.setText(item_name.get(position));
            h.pr.setText(price.get(position)+" Rs");
            h.btndelete.setId(Integer.parseInt(cart_id.get(position)));

            String path=GlobalURL.imgurl+item_photo.get(position).replace("\\","/");

            Glide.with(Cart.this).load(path).into(h.iv);
             h.qty.setText("Quantity : "+qty.get(position));
             h.tvt.setText("Total : "+String.valueOf(Integer.parseInt(qty.get(position))*Integer.parseInt(price.get(position))));

             h.btndelete.setOnClickListener(new View.OnClickListener() {
                 @Override
                 public void onClick(View v) {

                     int index=cart_id.indexOf(String.valueOf(v.getId()));
                     cart_id.remove(index);
                     item_name.remove(index);
                     price.remove(index);
                     item_photo.remove(index);
                     qty.remove(index);

                     DeleteCart obj=new DeleteCart(String.valueOf(v.getId()));
                     obj.execute();
                     notifyDataSetChanged();
                 }
             });

            return convertView;
        }
    }



     class DeleteCart extends  AsyncTask<Void,Void,Void>
     {

          String res,id;
          DeleteCart(String id)
          {
              this.id=id;
          }
         @Override
         protected void onPreExecute() {
             super.onPreExecute();

             pd = new ProgressDialog(Cart.this);
             pd.setMessage("Wait.....");

             pd.show();


         }

         @Override
         protected Void doInBackground(Void... voids) {

              WebServic obj=new WebServic();
             List<NameValuePair> list = new ArrayList<NameValuePair>();
list.add(new BasicNameValuePair("Cart_id",id));
             obj.PostData(GlobalURL.deletecart,list);
              return null;
         }

         @Override
         protected void onPostExecute(Void aVoid) {
             super.onPostExecute(aVoid);
             pd.dismiss();
             Toast.makeText(Cart.this,"Deleted From Cart",Toast.LENGTH_LONG).show();
         }

     }



}
