from django.shortcuts import render

#TO CREATE USER, KOPIERAT DETTA STYCKE
#from django.contrib.auth.models import User
# Create user and save to the database
#user = User.objects.create_user('myusername', 'myemail@crazymail.com', 'mypassword')
# Update fields and then save again
#user.first_name = 'John'
#user.last_name = 'Citizen'
#user.save()

# Create your views here.
# view function tar request och ger respons, kallas också view eller action

def login(request):
    login_data = request.POST
    login_data_list = list(login_data.values())[1:] #ger lista med de data som satts in
    print(login_data_list)
    #KOLLA LÖSENORDET OCH SKICKA ANVÄNDAREN VIDARE TILL HOMEPAGE FÖR USER

    return render(request, 'login.php')

def register(request):
    data = request.POST
    data_list = list(data.values())[1:] #ger lista med de data som satts in
    
    #This is were we pick out all the data in registration forum and insert as new user to database
    return render(request, 'user_reg.php')

#def logged_in(request):
#    return render(request, 'user_frontpage.php')