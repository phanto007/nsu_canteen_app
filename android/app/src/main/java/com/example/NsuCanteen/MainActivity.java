package com.example.NsuCanteen;

import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Intent;
import android.hardware.Camera;
import android.os.Build;
import android.provider.MediaStore;
import android.support.annotation.NonNull;
import android.support.annotation.RequiresApi;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Window;
import android.view.WindowManager;
import android.webkit.PermissionRequest;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.webkit.SslErrorHandler;
import android.net.http.SslError;

import java.util.List;

import pub.devrel.easypermissions.EasyPermissions;

/*import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Random;  */

public class MainActivity extends AppCompatActivity {
    private WebView webView;
    private  WebChromeClient webChromeClient;





  /*  ArrayList arrayList = new ArrayList();
    SwipeRefreshLayout mSwipeRefreshLayout;
    ListView mListView;*/


  /*  static final int REQUEST_IMAGE_CAPTURE = 1;

    private void dispatchTakePictureIntent() {
        Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            startActivityForResult(takePictureIntent, REQUEST_IMAGE_CAPTURE);
        }
    }*/

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
              WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_main);



        webView = (WebView) findViewById(R.id.webView);

        webView.setWebViewClient(new WebViewClient());
        webView.getSettings().setJavaScriptEnabled(true);
        webView.getSettings().setAppCacheEnabled(true);
        webView.getSettings().setUseWideViewPort(true);
        webView.getSettings().setLoadWithOverviewMode(true);
        webView.getSettings().setDomStorageEnabled(true);
        webView.setWebChromeClient(new WebChromeClient());
        webView.getSettings().setPluginState(WebSettings.PluginState.ON);



        webView.loadUrl("https://www.cryptomayday.com/");

        webView.setWebChromeClient(new WebChromeClient(){

            public void onPermissionRequest(final PermissionRequest request){
                MainActivity.this.runOnUiThread(new Runnable() {

                    @TargetApi(Build.VERSION_CODES.LOLLIPOP)
                    @Override
                    public void run() {
                        request.grant(request.getResources());
                    }
                });
            }


        });




        webView.setWebViewClient(new WebViewClient() {

            /*public void onPermissionRequest(final PermissionRequest request){
                MainActivity.this.runOnUiThread(new Runnable() {

                    @TargetApi(Build.VERSION_CODES.LOLLIPOP)
                    @Override
                    public void run() {
                        request.grant(request.getResources());
                    }
                });
            }*/

            @Override
            public void onReceivedSslError(WebView view, final SslErrorHandler handler, SslError error) {
                String message = "SSL Certificate error.";
                switch (error.getPrimaryError()) {
                    case SslError.SSL_UNTRUSTED:
                        message = "The certificate authority is not trusted.";
                        break;
                    case SslError.SSL_EXPIRED:
                        message = "The certificate has expired.";
                        break;
                    case SslError.SSL_IDMISMATCH:
                        message = "The certificate Hostname mismatch.";
                        break;
                    case SslError.SSL_NOTYETVALID:
                        message = "The certificate is not yet valid.";
                        break;
                }
                message += "\"SSL Certificate Error\" Do you want to continue anyway?.. YES";

                handler.proceed();
            }


            public void onReceivedError(WebView view, int errorCode, String description, String failingUrl){

                webView.loadUrl("file:///android_asset/error.html");
            }



        });




    }

    @Override
    public void onBackPressed() {
        if (webView.canGoBack()) {
            webView.goBack();
        } else {
            super.onBackPressed();
        }

    }




}