#här mappar vi url till view funktion
from django.urls import path
from . import views

#URL configuration model, varje app kan ha en egen sån, importeras till main configuration
urlpatterns = [
    path('', views.register),
    path('', views.login)
]