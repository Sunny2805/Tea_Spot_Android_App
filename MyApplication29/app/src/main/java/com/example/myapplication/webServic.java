package com.example.myapplication;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.List;

class WebServic {

    public String PostData(String globalURL, List<NameValuePair> list) {
        String s="";
        InputStream is=null;

        try
    {
        HttpClient httpClient=new DefaultHttpClient();
        HttpPost httpPost=new HttpPost(globalURL);

        httpPost.setEntity(new UrlEncodedFormEntity(list));
        HttpResponse httpResponse=  httpClient.execute(httpPost);

        HttpEntity httpEntity=httpResponse.getEntity();
        is=httpEntity.getContent();

        BufferedReader bufferedReader=new BufferedReader(new InputStreamReader(is));
        String line="";
        StringBuffer sb=new StringBuffer();
        while ((line=bufferedReader.readLine())!=null)
        {
            sb.append(line);
        }
        s=sb.toString();
    }
        catch(Exception exception)  {}
        return s;
}

}

