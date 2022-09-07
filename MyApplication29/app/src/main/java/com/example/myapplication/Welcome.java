package com.example.myapplication;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.bluetooth.BluetoothA2dp;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.net.nsd.NsdManager;
import android.os.AsyncTask;
import android.os.Bundle;

import com.bumptech.glide.Glide;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;

import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;

import androidx.annotation.NonNull;

import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.AppBarConfiguration;
import androidx.navigation.ui.NavigationUI;

import com.google.android.material.navigation.NavigationView;

import androidx.drawerlayout.widget.DrawerLayout;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.view.Menu;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

public class Welcome extends AppCompatActivity {

    private AppBarConfiguration mAppBarConfiguration;
    ProgressDialog pd;
    SharedPreferences shp;
    GridView gv;
    ArrayList<String> aa_cid,aa_name,aa_photo;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
       /* FloatingActionButton fab = findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });*/
        gv=findViewById(R.id.gv);
        shp=getSharedPreferences("mypref",0);

        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        NavigationView navigationView = findViewById(R.id.nav_view);
        // Passing each menu ID as a set of Ids because each
        // menu should be considered as top level destinations.
        mAppBarConfiguration = new AppBarConfiguration.Builder(
                R.id.nav_home, R.id.nav_gallery, R.id.nav_slideshow,
                R.id.nav_cart, R.id.nav_share, R.id.nav_send)
                .setDrawerLayout(drawer)
                .build();



        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment);
        NavigationUI.setupActionBarWithNavController(this, navController, mAppBarConfiguration);
        NavigationUI.setupWithNavController(navigationView, navController);
        navigationView.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {

                  switch (menuItem.getItemId())
                  {

                      case R.id.nav_cart:
                      Intent i1=new Intent(Welcome.this, Cart.class);
                      startActivity(i1);
                      break;

                      case R.id.nav_contract:
                          Intent i2=new Intent(Welcome.this, contract.class);
                          startActivity(i2);
                          break;
                      case R.id.nav_home:
                          Intent ihome=new Intent(Welcome.this, Welcome.class);
                          startActivity(ihome);
                          finish();
                          break;
                      case R.id.nav_profile:
                          Intent i4=new Intent(Welcome.this, userprofile.class);
                          startActivity(i4);
                          break;

                      case R.id.nav_cp:
                          Intent i5=new Intent(Welcome.this, chng_password.class);
                          startActivity(i5);
                          break;
                      case R.id.nav_feedback:
                          Intent i6=new Intent(Welcome.this, feedback.class);
                          startActivity(i6);
                          break;
                      case R.id.nav_viewcontract:
                          Intent i7=new Intent(Welcome.this, viewcontract.class);
                          startActivity(i7);

                          break;

                      case R.id.nav_vieworder:
                          Intent i8=new Intent(Welcome.this, vieworder1.class);
                          startActivity(i8);

                          break;

                      case R.id.nav_logout:
                          AlertDialog.Builder aa=new AlertDialog.Builder(Welcome.this,R.style.MyDialogTheam);
                          aa.setMessage("Do you want to logout?");

                          aa.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
                              @Override
                              public void onClick(DialogInterface dialog, int which) {



                                  SharedPreferences.Editor ed=shp.edit();
                                  ed.clear();
                                  ed.commit();

                                  Intent i1=new Intent(Welcome.this,MainActivity.class);
                                  startActivity(i1);
                                  finish();


                              }
                          });
                          aa.setNegativeButton("No", new DialogInterface.OnClickListener() {
                              @Override
                              public void onClick(DialogInterface dialog, int which) {


                              }
                          });




/*
                          AlertDialog aa1=aa.create();
                          aa1.setOnShowListener(new DialogInterface.OnShowListener() {
                              @Override
                              public void onShow(DialogInterface dialog) {
                                  Button pbtn=((AlertDialog)dialog).getButton(DialogInterface.BUTTON_POSITIVE);
                                  pbtn.setBackgroundColor(Color.BLUE);
                                  Button nbtn=((AlertDialog)dialog).getButton(DialogInterface.BUTTON_NEGATIVE);
                                  nbtn.setBackgroundColor(Color.BLUE);

                                  pbtn.invalidate();
                                  nbtn.invalidate();

                              }
                          });
*/
                          aa.show();


                  }

                return false;



            }
        });



        gv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i=new Intent(Welcome.this,get_item.class);
                i.putExtra("cid",aa_cid.get(position));
                startActivity(i);
            }
        });

          new getcategory().execute();

          TextView tvname=navigationView.getHeaderView(0).findViewById(R.id.textView);
          tvname.setText(shp.getString("na",""));
        }


    class getcategory extends AsyncTask<Void,Void,Void>{
        String res;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd=new ProgressDialog(Welcome.this);
            pd.setMessage("Wait.....");
            pd.show();
            aa_cid=new ArrayList<>();
            aa_name=new ArrayList<>();
            aa_photo=new ArrayList<>();

        }


        @Override

        protected Void doInBackground(Void... voids) {
            WebServic obj=new WebServic();
            List<NameValuePair> list = new ArrayList<NameValuePair>();
            res = obj.PostData(GlobalURL.getcategory, list);
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
                    aa_cid.add(data.getString("cid"));
                    aa_name.add(data.getString("cname"));
                    aa_photo.add(data.getString("photo"));

                }

                gv.setAdapter(new mybase());

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
            inflater=LayoutInflater.from(Welcome.this);
        }

        @Override
        public int getCount() {
            return aa_cid.size() ;
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
            TextView tv,pr;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            Welcome.mybase.ViewHolder h;
            if(convertView==null)
            {
                h=new ViewHolder();
                convertView=inflater.inflate(R.layout.categoryrow,null);
                h.iv=convertView.findViewById(R.id.iv);
                h.tv=convertView.findViewById(R.id.tv);
                convertView.setTag(h);
            }
            else
            {
                h=(ViewHolder) convertView.getTag();

            }
                h.tv.setText(aa_name.get(position));

           String path=GlobalURL.imgurl+aa_photo.get(position).replace("\\","/");
            Glide.with(Welcome.this).load(path).into(h.iv);

            return convertView;
        }
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.welcome, menu);
        return true;
    }

    @Override
    public boolean onSupportNavigateUp() {
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment);
        return NavigationUI.navigateUp(navController, mAppBarConfiguration)
                || super.onSupportNavigateUp();

    }


}

