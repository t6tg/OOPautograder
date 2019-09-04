
import java.util.Scanner;


public class Main {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        int n = input.nextInt();
        int number = 1;
        if(n >= 2 && n <= 1000){
        for(int i = 1; i <= n; i++) {
            for(int j = 1; j <= i; j++) {
                System.out.print(number + " |");
                ++number;
            }
            System.out.println();
            }
        }
    }
}

