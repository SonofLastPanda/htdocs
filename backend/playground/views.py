from django.shortcuts import render
from django.http import HttpResponse
from databaseapp.models import Users ##From the database
from django.contrib.auth.models import User
from .forms import UserCreationForm
from django.contrib.auth.hashers import make_password
# Create your views here.

##not complete
def register(request):
    if request.method == 'POST':
        #received_json_data = json.loads(request.body) #depends on if the request is json
        received_data=request.body
        user = Users() #from databaseApplication.models import Users ##From the database
        user.email = received_data.get('email', None)
        user.password = received_data.get('password', None)
        user.age=received_data.get('age', None)
        user.citizenship=received_data.get('age', None)
        user.save()
        ##########################
        profile = User() ##from django.contrib.auth.models import User  #from the database
        profile.first_name = received_data.get('first_name', None)
        profile.last_name = received_data.get('last_name', None)
        profile.email = received_data.get('email', None)
        profile.username = received_data.get('username', None)
        profile.password = make_password(received_data.get('password', None))
        profile.save()

    form = UserCreationForm(request.POST)
    return render(request,'user_reg.php', {'form': form})
    