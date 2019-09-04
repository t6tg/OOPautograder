
import java.util.Scanner;

class Main {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        
        System.out.print("Please enter number1: ");
        float a = input.nextFloat();
        System.out.print("Please enter number2: ");
        float b = input.nextFloat();
        
        float sum = 0;
        System.out.print("Please enter operator: ");
        char x = input.next().charAt(0);
        
        if (x == '+'){
            sum = a+b;
            System.out.println("Result is = "+sum);
        }else if(x == '*'){
            sum = a*b;
            System.out.println("Result is = "+sum);
        }else if(x == '-'){
            sum = a-b;
            System.out.println("Result is = "+sum);
        }else if(x == '/'){
            sum = a/b;
            System.out.println("Result is = "+sum);
        }else{
            System.out.println("Result is = "+sum);
        }
        

    }
    
}
