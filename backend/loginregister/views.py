from django.shortcuts import render

# Create your views here.
# view function tar request och ger respons, kallas också view eller action

def register(request):
    data = request.POST
    data_list = list(data.values())[1:] #ger lista med de data som satts in
    
    #This is were we pick out all the data in registration forum and insert as new user to database
    return render(request, 'user_reg.php')

def login(request):
   # data = request.POST
    #data_list = list(data.values())[1:] #ger lista med de data som satts in

    return render(request, 'login.html')