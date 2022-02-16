from django import forms
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth.models import User


class UserRegisterForm(UserCreationForm):
    email = forms.EmailField(required=True)
    age=forms.IntegerField()
    citizenship=forms.CharField()
    class Meta:
        model = User
        fields = (
            'email',
            'password1',
            'password2',
            'age',
            'citizenship',
        )

    def save(self, commit=True):
        user = super(UserRegisterForm, self).save(commit=False)
        user.email = self.cleaned_data['email']
        user.age = self.cleaned_data['age']
        user.citizenship = self.cleaned_data['citizenship']

        if commit:
            user.save()

        return user