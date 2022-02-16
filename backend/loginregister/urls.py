#här mappar vi url till view funktion
from django.urls import path, include
from loginregister import views

#URL configuration model, varje app kan ha en egen sån, importeras till main configuration
urlpatterns = [
    path('', views.login),
    path('', views.register),
    path('accounts/', include('django.contrib.auth.urls')), #for user handling (login, logout, password etc)
]