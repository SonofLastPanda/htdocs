"""CoTRACK URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/3.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path, include #include for login och för nya appen
from django.views.generic.base import TemplateView #for the homepage

urlpatterns = [
    path('admin/', admin.site.urls),
    path('loginregister/', include('loginregister.urls')), #alla url som börjar med login_registrer kommer hanteras av login_registrer url appen
    path('', TemplateView.as_view(template_name='index.php'), name='home'), #for the home page
    path('accounts/', include('django.contrib.auth.urls')), #for login
]
