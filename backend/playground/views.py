from django.shortcuts import render
from django.http import HttpResponse
# Create your views here.

##not complete
def register(request):
    if request.method == 'POST':
        received_json_data = json.loads(request.body) #depends on if the request is json 
        user = Users() #from databaseApplication.models import Users ##From the database
        user.name = received_json_data.get('username', None)
        user.password = received_json_data.get('password', None)
        user.mail_adress=received_json_data.get('email', None)
        user.save()
        ##########################
        profile = User() ##from django.contrib.auth.models import User  #from the database
        profile.first_name = received_json_data.get('first_name', None)
        profile.last_name = received_json_data.get('last_name', None)
        profile.email = received_json_data.get('email', None)
        profile.username = received_json_data.get('username', None)
        profile.password = make_password(received_json_data.get('password', None))
        profile.save()

    form = UserCreationForm(request.POST)
    return render(request,'signup.html', {'form': form})